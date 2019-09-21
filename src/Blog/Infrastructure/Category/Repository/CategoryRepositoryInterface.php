<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;

interface CategoryRepositoryInterface
{
    public function find(AggregateRootId $id): CategoryView;

    public function findOneBy(array $data): ?CategoryView;

    public function apply(): void;

    public function store(CategoryView $category): void;

    public function remove(CategoryView $category): void;
}
