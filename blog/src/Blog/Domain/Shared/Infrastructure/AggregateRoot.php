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
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    abstract public function serialize(): array;

    abstract public static function unserialize(array $data): AggregateRoot;
}
