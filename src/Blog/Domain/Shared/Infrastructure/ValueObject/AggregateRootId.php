<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ValueObject;

use App\Blog\Domain\Shared\Infrastructure\Uuid\UuidInterface;

class AggregateRootId
{
    /**
     * @var UuidInterface
     */
    private $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function withId(UuidInterface $id): self
    {
        return new self($id);
    }

    public function toString(): string
    {
        return $this->id->toString();
    }

    public function __toString()
    {
        return $this->toString();
    }
}
