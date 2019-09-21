<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

interface PostStoreRepositoryInterface
{
    public function find(AggregateRootId $id): Post;

    public function apply(): void;

    public function store(Post $post): void;
}
