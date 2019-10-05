<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\StoreRepository;

use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessorInterface;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClientInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class MysqlRepository.
 */
abstract class StoreRepository
{
    protected $events = [];

    private $projectionProcessor;

    private $client;

    public function apply(): void
    {
        foreach ($this->events as $event) {
            $this->projectionProcessor->process($event);
            $this->client->publish(new AMQPMessage(serialize($event)), '', get_class($event));
        }
    }

    /**
     * MysqlRepository constructor.
     */
    public function __construct(ProjectionProcessorInterface $projectionProcessor, RabbitmqClientInterface $client)
    {
        $this->projectionProcessor = $projectionProcessor;
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
