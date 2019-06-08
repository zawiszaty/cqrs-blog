<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Store;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ORM\RedisAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Shared\StoreRepository\AbstractRedisStoreRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RedisCategoryStoreRepository extends AbstractRedisStoreRepository implements CategoryStoreRepositoryInterface
{
    public function __construct(RedisAdapter $redisAdapter, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($redisAdapter, $eventDispatcher);
        $this->className = 'category';
    }

    public function store(Category $category): void
    {
        $this->save($category);
    }

    public function get(AggregateRootId $aggregateRootId): Category
    {
        $data = $this->find($aggregateRootId);
        /** @var Category $category */
        $category = Category::unserialize($data);

        return $category;
    }

    public function remove(Category $category): void
    {
        $this->delete($category);
    }
}
