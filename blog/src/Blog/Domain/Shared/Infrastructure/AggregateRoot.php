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
     * @var array
     */
    protected $unCommittedEvent = [];

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getUnCommittedEvent(): array
    {
        return $this->unCommittedEvent;
    }

    protected function __construct()
    {
    }

    abstract public static function unserialize(array $data): AggregateRoot;

    abstract public function apply(Event $event): void;

    protected function record(Event $event): void
    {
        $this->unCommittedEvent[] = $event;
        $this->apply($event);
    }
}
