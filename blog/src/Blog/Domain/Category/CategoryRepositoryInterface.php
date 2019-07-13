<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

interface CategoryRepositoryInterface
{
    public function find(AggregateRootId $id): Category;

    public function apply(): void;

    public function store(Category $category): void;
}
