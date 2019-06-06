<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Event;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class DeleteCategoryEvent extends Event
{
    /**
     * @var AggregateRootId
     */
    private $id;

    /**
     * DeleteCategoryEvent constructor.
     *
     * @param AggregateRootId $id
     */
    public function __construct(AggregateRootId $id)
    {
        $this->id = $id;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id->toString(),
        ];
    }
}
