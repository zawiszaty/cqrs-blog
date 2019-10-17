<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Events;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class CategoryWasEditedEvent extends Event
{
    private $id;

    private $name;

    public function __construct(AggregateRootId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }
}
