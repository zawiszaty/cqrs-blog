<?php

declare(strict_types=1);

namespace App\Symfony;

use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParamConverter implements ParamConverterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration)
    {
        $class = $configuration->getClass();

        $name = $configuration->getName();
        $mappings = $configuration->getOptions()['mapping_by'];
        $query = $this->entityManager->createQueryBuilder()->select('class')
            ->from($class, 'class');

        foreach ($mappings as $index => $mapping) {
            $query->where("class.$mapping = ?1")->setParameter('1', $request->get($index));
        }
        $query->setMaxResults(1);
        $result = $query->getQuery()->getArrayResult();

        if (0 === count($result) )
        {
            throw new NotFoundHttpException();
        }
        $data = explode('::', $request->attributes->get('_controller'));
        $controller = new ReflectionClass($data[0]);
        /** @var \ReflectionMethod $method */
        $method = $controller->getMethod($data[1]);

        /** @var \ReflectionParameter $parameter */
        foreach ($method->getParameters() as $parameter) {
            if ($parameter->getName() === $name) {
                /** @var ReflectionClass $class */
                $class = $parameter->getClass();
                $className = $class->name;
                $dto = new $className($result[0]);
                $request->attributes->set($name, $dto);
                break;
            }
        }
    }

    public function supports(\Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration)
    {
        if (!array_key_exists('mapping_by', $configuration->getOptions()) && '' !== $configuration->getClass()) {
            return false;
        }

        return true;
    }
}
