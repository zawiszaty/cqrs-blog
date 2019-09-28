<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\StoreRepository;

use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessorInterface;

/**
 * Class MysqlRepository.
 */
abstract class StoreRepository
{
    /**
     * @var array
     */
    protected $events = [];
    /**
     * @var ProjectionProcessorInterface
     */
    private $projectionProcessor;

    public function apply(): void
    {
        foreach ($this->events as $event) {
            $this->projectionProcessor->process($event);
        }
    }

    /**
     * MysqlRepository constructor.
     */
    public function __construct(ProjectionProcessorInterface $projectionProcessor)
    {
        $this->projectionProcessor = $projectionProcessor;
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}
