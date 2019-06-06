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

    public function set(string $key, string $value): void
    {
        $this->client->set($key, $value);
    }

    public function get(string $key): string
    {
        return $this->client->get($key);
    }

    public function hmset(string $hash, array $data)
    {
        $this->client->hmset($hash, $data);
    }

    public function hgetall(string $hash): array
    {
        return $this->client->hgetall($hash);
    }

    public function key(string $key): array
    {
        return $this->client->keys($key);
    }

    public function flushall(): void
    {
        $this->client->flushall();
    }
}
