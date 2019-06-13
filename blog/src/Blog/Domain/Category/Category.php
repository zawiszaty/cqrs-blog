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
     * @var Name|string
     */
    private $name;

    private function __construct(AggregateRootId $aggregateRootId, Name $name)
    {
        parent::__construct($aggregateRootId);
        $this->name = $name;
    }

    public static function create(Name $name): self
    {
        $category = new self(
            AggregateRootId::withId(RamseyUuidAdapter::generate()),
            $name
        );

        return $category;
    }

    public function edit(Name $name)
    {
        $this->name = $name;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        if (is_string($this->name)) {
            return Name::withName($this->name);
        }

        return $this->name;
    }
}
