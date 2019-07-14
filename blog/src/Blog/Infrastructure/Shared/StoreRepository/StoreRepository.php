<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\StoreRepository;

use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessor;

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
     * @var ProjectionProcessor
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
    public function __construct(ProjectionProcessor $projectionProcessor)
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
