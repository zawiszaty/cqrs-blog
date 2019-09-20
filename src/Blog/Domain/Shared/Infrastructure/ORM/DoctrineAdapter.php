<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ORM;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineAdapter implements ORMAdapterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getRepository(string $model): object
    {
        return $this->entityManager->getRepository($model);
    }

    public function persist(object $model): void
    {
        $this->entityManager->persist($model);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function remove(object $model): void
    {
        $this->entityManager->remove($model);
    }
}
