<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;

class CategoryFinder extends MysqlRepository implements CategoryFinderInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = CategoryView::class;
        parent::__construct($entityManager);
    }

    public function getAll(int $page, int $limit): array
    {
        $qb = $this
            ->repository
            ->createQueryBuilder('category')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        $model = $qb->getQuery()->setCacheable(true)
            ->getArrayResult();
        $qbCount = $this
            ->repository
            ->createQueryBuilder('category')
            ->select('count(category.id)');
        $count = $qbCount->getQuery()->setCacheable(true)
            ->execute();
        $data = [
            'data' => $model,
            'total' => $count[0][1],
        ];

        return $data;
    }

    public function findOneByName(string $name): ?CategoryView
    {
        /** @var CategoryView $categoryView */
        $categoryView = $this
            ->repository
            ->createQueryBuilder('category')
            ->where('category.name = :name')
            ->setParameter('name', $name)
            ->getQuery()->setCacheable(true)
            ->getOneOrNullResult();

        return $categoryView;
    }

    public function get(string $id): ?CategoryView
    {
        /** @var CategoryView $categoryView */
        $categoryView = $this
            ->repository
            ->createQueryBuilder('category')
            ->where('category.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->setCacheable(true)
            ->getOneOrNullResult();

        return $categoryView;
    }
}
