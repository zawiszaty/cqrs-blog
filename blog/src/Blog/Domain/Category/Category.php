<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Category\Event\CreateCategoryEvent;
use App\Blog\Domain\Category\Event\DeleteCategoryEvent;
use App\Blog\Domain\Category\Event\EditCategoryEvent;
use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class Category extends AggregateRoot
{
    /**
     * @var Name
     */
    private $name;

    public static function create(Name $name): self
    {
        $category = new self();
        $category->record(new CreateCategoryEvent(AggregateRootId::withId(RamseyUuidAdapter::generate()), $name));

        return $category;
    }

    public function edit(Name $name)
    {
        $this->record(new EditCategoryEvent($this->id, $name));
    }

    public function delete()
    {
        $this->record(new DeleteCategoryEvent($this->id));
    }

    public static function unserialize(array $data): AggregateRoot
    {
        $category = new self();
        $category->id = AggregateRootId::withId(RamseyUuidAdapter::fromString($data['id']));
        $category->name = Name::withName($data['name']);

        return $category;
    }

    public function apply(Event $event): void
    {
        if ($event instanceof CreateCategoryEvent) {
            $this->id = $event->getId();
            $this->name = $event->getName();
        } elseif ($event instanceof EditCategoryEvent) {
            $this->name = $event->getName();
        }
    }
}
