<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Store;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Infrastructure\Shared\StoreRepository\InMemoryStoreRepository;

class InMemoryCategoryStoreRepository extends InMemoryStoreRepository implements CategoryStoreRepositoryInterface
{
    public function store(Category $category)
    {
        $this->apply($category);
    }
}
