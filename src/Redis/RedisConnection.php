<?php

namespace App\Redis;

use Predis\Client;

/**
 * Class RedisConnection
 * @package App\Redis
 */
class RedisConnection
{
    /**
     * @var Client
     */
    private $connection;

    /**
     * RedisConnection constructor.
     */
    public function __construct()
    {
        $this->connection = new Client('tcp://cqrs-blog-redis:6379');
    }

    /**
     * @return Client
     */
    public function getConnection():Client
    {
        return $this->connection;
    }
}