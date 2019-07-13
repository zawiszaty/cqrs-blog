<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Events;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class CategoryWasDeletedEvent extends Event
{
    /**
     * @var AggregateRootId
     */
    private $id;

    /**
     * UserWasCreatedEvent constructor.
     *
     * @param AggregateRootId $id
     */
    public function __construct(AggregateRootId $id)
    {
        $this->id = $id;
    }

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }
}
