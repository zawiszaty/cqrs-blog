<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ORM;

use PHPUnit\Framework\TestCase;

class RedisAdapterTest extends TestCase
{
    public function test_it_create_client()
    {
        $client = new RedisAdapter([
            'host' => 'redis',
            'scheme' => 'tcp',
            'port' => 6379,
        ]);
        $responses = $client->transaction()->set('foo', 'bar')->get('foo')->execute();
        $this->assertNotNull($responses);
    }
}
