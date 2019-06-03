<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

interface CategoryStoreRepositoryInterface
{
    public function store(Category $category);
}
