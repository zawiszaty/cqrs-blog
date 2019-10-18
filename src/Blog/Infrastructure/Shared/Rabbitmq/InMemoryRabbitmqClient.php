<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Rabbitmq;

use PhpAmqpLib\Message\AMQPMessage;

final class InMemoryRabbitmqClient implements RabbitmqClientInterface
{
    public function publish(AMQPMessage $msg, string $exchange, string $route): void
    {
        // TODO: Implement publish() method.
    }

    public function queue(string $name): void
    {
        // TODO: Implement queue() method.
    }

    public function consume(string $queue, \Closure $param): void
    {
        // TODO: Implement consume() method.
    }

    public function is_consuming(): bool
    {
        return false;
    }

    public function wait(): void
    {
        // TODO: Implement wait() method.
    }
}
