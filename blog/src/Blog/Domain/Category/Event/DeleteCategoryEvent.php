<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Event;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use Symfony\Contracts\EventDispatcher\Event;

class DeleteCategoryEvent extends Event implements \App\Blog\Domain\Shared\Infrastructure\Event
{
    public const NAME = 'app.projection.redis.delete_category_projection';

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

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }
}
