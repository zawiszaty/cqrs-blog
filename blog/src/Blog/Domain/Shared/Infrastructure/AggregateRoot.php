<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure;

use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

abstract class AggregateRoot
{
    /**
     * @var AggregateRootId|string
     */
    protected $id;

    /**
     * AggregateRoot constructor.
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
        if (is_string($this->id)) {
            return AggregateRootId::withId(RamseyUuidAdapter::fromString($this->id));
        }

        return $this->id;
    }
}
