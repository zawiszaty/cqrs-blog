<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Processor;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClient;
use PhpAmqpLib\Message\AMQPMessage;

class AsyncProjectionProcessor implements ProjectionProcessorInterface
{
    /**
     * @var RabbitmqClient
     */
    private $client;

    public function __construct(RabbitmqClient $client)
    {
        $this->client = $client;
    }

    public function process(Event $event): void
    {
        $msg = new AMQPMessage(serialize($event));
        $this->client->publish($msg, '', 'projection');
    }
}
