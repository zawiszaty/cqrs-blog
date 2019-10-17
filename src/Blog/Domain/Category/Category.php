<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasDeletedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
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
        $category->record(new CategoryWasCreatedEvent(
            AggregateRootId::withId(RamseyUuidAdapter::generate()),
            $name
        ));

        return $category;
    }

    public function edit(Name $name): void
    {
        $this->record(new CategoryWasEditedEvent(
            $this->id,
            $name
        ));
    }

    public function delete()
    {
        $this->record(new CategoryWasDeletedEvent($this->id));
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function apply(Event $event): void
    {
        if ($event instanceof CategoryWasCreatedEvent) {
            $this->applyUserWasCreatedEvent($event);
        } elseif ($event instanceof CategoryWasEditedEvent) {
            $this->applyUserWasEditedEvent($event);
        }
    }

    private function applyUserWasCreatedEvent(CategoryWasCreatedEvent $event): void
    {
        $this->id = $event->getId();
        $this->name = $event->getName();
    }

    private function applyUserWasEditedEvent(CategoryWasEditedEvent $event): void
    {
        $this->name = $event->getName();
    }

    public static function withData(array $data): Category
    {
        $category = new self();
        $category->id = $data['id'];
        $category->name = $data['name'];

        return $category;
    }
}
