<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Event;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use Symfony\Contracts\EventDispatcher\Event;

class CreateCategoryEvent extends Event implements \App\Blog\Domain\Shared\Infrastructure\Event
{
    public const NAME = 'app.projection.redis.add_category_projection';
    /**
     * @var AggregateRootId
     */
    private $id;
    /**
     * @var Name
     */
    private $name;

    /**
     * CreateCategoryEvent constructor.
     *
     * @param AggregateRootId $id
     * @param Name            $name
     */
    public function __construct(AggregateRootId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    public function serialize(): array
    {
        return [
            'id' => $this->getId()->toString(),
            'name' => $this->name->toString(),
        ];
    }
}
