<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class Category extends AggregateRoot
{
    /**
     * @var Name
     */
    private $name;
    /**
     * @var AggregateRootId
     */
    private $aggregateRootId;

    private function __construct(AggregateRootId $aggregateRootId, Name $name)
    {
        $this->aggregateRootId = $aggregateRootId;
        $this->name = $name;
    }

    public static function create(Name $name): self
    {
        $category = new self(AggregateRootId::withId(RamseyUuidAdapter::generate()), $name);

        return $category;
    }
}
