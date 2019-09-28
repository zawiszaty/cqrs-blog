<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Infrastructure\Shared\Collection\DataCollection;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;

final class PostFinder extends MysqlRepository implements PostFinderInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = PostView::class;
        parent::__construct($entityManager);
    }

    public function getAll(int $page, int $limit): DataCollection
    {
        $qb = $this
            ->repository
            ->createQueryBuilder('post')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        $model = $qb->getQuery()->setCacheable(true)
            ->getArrayResult();
        $qbCount = $this
            ->repository
            ->createQueryBuilder('post')
            ->select('count(post.id)');
        $count = $qbCount->getQuery()->setCacheable(true)
            ->getSingleScalarResult();
        $data = new DataCollection($model, (int) $count);

        return $data;
    }

    public function findOneByName(string $title): ?PostView
    {
        /** @var PostView $postView */
        $postView = $this
            ->repository
            ->createQueryBuilder('post')
            ->where('post.name = :title')
            ->setParameter('title', $title)
            ->getQuery()->setCacheable(true)
            ->getOneOrNullResult();

        return $postView;
    }

    public function get(string $id): ?PostView
    {
        /** @var PostView $postView */
        $postView = $this
            ->repository
            ->createQueryBuilder('post')
            ->where('post.id = :id')
            ->setParameter('id', $id)
            ->getQuery()->setCacheable(true)
            ->getOneOrNullResult();

        return $postView;
    }
}
