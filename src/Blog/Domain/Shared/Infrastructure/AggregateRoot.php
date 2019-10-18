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
    private $unCommittedEvent = [];

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    protected function record(Event $event): void
    {
        $this->unCommittedEvent[] = $event;
        $this->apply($event);
    }

    public function commitEvent(): void
    {
        $this->unCommittedEvent = [];
    }

    abstract public function apply(Event $event): void;

    /**
     * @return array
     */
    public function getUnCommittedEvent(): array
    {
        return $this->unCommittedEvent;
    }
}
