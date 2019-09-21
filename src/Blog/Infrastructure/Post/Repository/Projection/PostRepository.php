<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Post\Repository\PostRepositoryInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;

final class PostRepository extends MysqlRepository implements PostRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = PostView::class;
        parent::__construct($entityManager);
    }

    public function find(AggregateRootId $id): PostView
    {
        /** @var PostView $postView */
        $postView = $this->repository->find($id->toString());

        return $postView;
    }

    public function findOneBy(array $data): ?PostView
    {
        /** @var PostView|null $postView */
        $postView = $this->repository->findOneBy($data);

        return $postView;
    }

    public function store(PostView $post): void
    {
        $this->register($post);
        $this->apply();
    }

    public function remove(PostView $post): void
    {
        $this->entityManager->remove($post);
    }
}
