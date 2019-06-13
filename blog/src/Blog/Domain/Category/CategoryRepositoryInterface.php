<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $postView): void;

    public function delete(string $id): void;

    public function find(string $id): Category;

    public function apply(): void;
}
