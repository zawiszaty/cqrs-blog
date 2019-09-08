<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Category;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasDeletedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testItCreateCategory()
    {
        $category = Category::create(Name::withName('test'));
        $events = $category->getUnCommitedEvent();
        $this->assertInstanceOf(CategoryWasCreatedEvent::class, $events[0]);
        /** @var CategoryWasCreatedEvent $userWasCreatedEvent */
        $userWasCreatedEvent = $events[0];
        $this->assertSame('test', $userWasCreatedEvent->getName()->toString());
    }

    public function testItWasEditCategory()
    {
        $category = Category::create(Name::withName('test'));
        $category->edit(Name::withName('test2'));
        $events = $category->getUnCommitedEvent();
        $this->assertInstanceOf(CategoryWasEditedEvent::class, $events[1]);
        /** @var CategoryWasEditedEvent $userWasCreatedEvent */
        $userWasCreatedEvent = $events[1];
        $this->assertSame('test2', $userWasCreatedEvent->getName()->toString());
    }

    public function testItWasDeletedCategory()
    {
        $category = Category::create(Name::withName('test'));
        $category->delete();
        $events = $category->getUnCommitedEvent();
        $this->assertInstanceOf(CategoryWasDeletedEvent::class, $events[1]);
        /** @var CategoryWasDeletedEvent $userWasCreatedEvent */
        $userWasCreatedEvent = $events[1];
        $this->assertSame($category->getId()->toString(), $userWasCreatedEvent->getId()->toString());
    }
}
