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

    public function serialize(): array
    {
        if ($this->id instanceof AggregateRootId && $this->name instanceof Name) {
            return [
                'id' => $this->id->toString(),
                'name' => $this->name->toString(),
            ];
        }
        throw new \Exception();
    }

    public function deSerialize(array $data): AggregateRoot
    {
        return new self(
            AggregateRootId::withId($data['id']),
            Name::withName($data['name'])
        );
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
