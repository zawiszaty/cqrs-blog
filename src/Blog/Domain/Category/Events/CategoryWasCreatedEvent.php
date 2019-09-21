<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Events;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class CategoryWasCreatedEvent extends Event
{
    /**
     * @var AggregateRootId
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * UserWasCreatedEvent constructor.
     *
     * @param AggregateRootId $id
     * @param Name            $name
     */
    public function __construct(AggregateRootId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }
}
