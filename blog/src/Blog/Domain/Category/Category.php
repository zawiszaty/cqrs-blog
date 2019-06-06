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

    private function __construct(AggregateRootId $aggregateRootId, Name $name)
    {
        $this->id = $aggregateRootId;
        $this->name = $name;
    }

    public static function create(Name $name): self
    {
        $category = new self(AggregateRootId::withId(RamseyUuidAdapter::generate()), $name);

        return $category;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->getId()->toString(),
            'name' => $this->name->toString(),
        ];
    }

    public static function unserialize(array $data): AggregateRoot
    {
        $category = new self(
            AggregateRootId::withId($data['id']),
            Name::withName($data['name'])
        );

        return $category;
    }
}
