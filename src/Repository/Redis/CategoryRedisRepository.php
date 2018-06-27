<?php

namespace App\Repository\Redis;

use App\Query\CategoryQuery;
use App\Query\View\CategoryView;
use App\Redis\RedisConnection;
use App\System\Query;

/**
 * Class CategoryRedisRepository
 * @package App\Repository\Redis
 */
class CategoryRedisRepository implements Query, CategoryQuery
{
    /**
     * @var RedisConnection
     */
    private $redisConnection;

    /**
     * CategoryRedisRepository constructor.
     * @param RedisConnection $redisConnection
     */
    public function __construct(RedisConnection $redisConnection)
    {
        $this->redisConnection = $redisConnection->getConnection();
    }

    /**
     * @param string $id
     * @return CategoryView
     */
    public function get(string $id): CategoryView
    {
        $rawPostView = $this->redisConnection->hgetall(sprintf('category:%s', $id));

        return new CategoryView($rawPostView['id'],$rawPostView['name']);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $categoryIds = $this->redisConnection->lrange('category', 0, -1);

        if (empty($categoryIds)) {
            return [];
        }
        $posts = [];

        foreach ($categoryIds as $categoryId) {
            $posts[] = $this->get(explode(':', $categoryId)[1]);
        }

        return $posts;
    }
}