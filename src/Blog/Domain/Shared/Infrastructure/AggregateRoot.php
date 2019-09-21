<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

abstract class AggregateRoot
{
    /**
     * @var AggregateRootId
     */
    protected $id;

    /**
     * @var array<Event>
     */
    private $unCommitedEvent = [];

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    protected function record(Event $event)
    {
        $this->unCommitedEvent[] = $event;
        $this->apply($event);
    }

    public function commitEvent(): void
    {
        $this->unCommitedEvent = [];
    }

    abstract public function apply(Event $event): void;

    /**
     * @return array
     */
    public function getUnCommitedEvent(): array
    {
        return $this->unCommitedEvent;
    }
}
