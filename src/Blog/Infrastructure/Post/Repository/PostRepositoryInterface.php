<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Post\Repository\Projection\PostView;

interface PostRepositoryInterface
{
    public function find(AggregateRootId $id): PostView;

    public function findOneBy(array $data): ?PostView;

    public function apply(): void;

    public function store(PostView $post): void;

    public function remove(PostView $post): void;
}
