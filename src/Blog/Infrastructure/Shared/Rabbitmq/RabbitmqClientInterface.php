<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Rabbitmq;

use PhpAmqpLib\Message\AMQPMessage;

interface RabbitmqClientInterface
{
    public function publish(AMQPMessage $msg, string $exchange, string $route): void;

    public function queue(string $name): void;

    public function consume(string $queue, \Closure $param): void;

    public function is_consuming(): bool;

    public function wait(): void;
}
