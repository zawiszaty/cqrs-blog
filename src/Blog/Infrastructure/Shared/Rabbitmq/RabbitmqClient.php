<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

final class RabbitmqClient
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;
    /**
     * @var \PhpAmqpLib\Channel\AMQPChannel
     */
    private $channel;

    public function __construct(
        string $rabbitmqHost,
        string $rabbitmgPort,
        string $rabbitmqUser,
        string $rabbitmqPassword
    ) {
        $this->connection = new AMQPStreamConnection($rabbitmqHost, $rabbitmgPort, $rabbitmqUser, $rabbitmqPassword);
        $this->channel = $this->connection->channel();
    }

    public function publish(AMQPMessage $msg, string $exchange, string $route)
    {
        $this->channel->basic_publish($msg, $exchange, $route);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
