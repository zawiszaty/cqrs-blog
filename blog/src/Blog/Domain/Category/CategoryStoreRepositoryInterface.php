<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

interface CategoryStoreRepositoryInterface
{
    public function store(Category $category): void;

    public function remove(Category $category): void;

    public function get(AggregateRootId $id): Category;
}
