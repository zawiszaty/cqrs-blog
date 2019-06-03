<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ORM;

use Predis\Client;

class RedisAdapter implements ORMAdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(array $redisParams)
    {
        $this->client = new Client([
            'scheme' => $redisParams['scheme'],
            'host' => $redisParams['host'],
            'port' => $redisParams['port'],
        ]);
    }

    public function transaction()
    {
        return $this->client->transaction();
    }
}
