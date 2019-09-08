<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ProjectionRepository;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MysqlRepository.
 */
abstract class MysqlRepository
{
    /**
     * @var array
     */
    protected $events = [];

    public function register(object $model): void
    {
        $this->entityManager->persist($model);
        $this->apply();
    }

    public function apply(): void
    {
        $this->entityManager->flush();
    }

    protected function oneOrException(QueryBuilder $queryBuilder)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult();
        if (null === $model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

    private function setRepository(string $model): void
    {
        /** @var EntityRepository $objectRepository */
        $objectRepository = $this->entityManager->getRepository($model);
        $this->repository = $objectRepository;
    }

    /**
     * MysqlRepository constructor.
     */
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->setRepository($this->class);
    }

    /** @var string */
    protected $class;
    /** @var EntityRepository */
    protected $repository;
    /**
     * @var ORMAdapterInterface
     */
    protected $entityManager;

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
