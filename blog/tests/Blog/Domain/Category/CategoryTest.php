<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Category;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\Event\CreateCategoryEvent;
use App\Blog\Domain\Category\Event\DeleteCategoryEvent;
use App\Blog\Domain\Category\Event\EditCategoryEvent;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_it_create_category()
    {
        $category = Category::create(Name::withName('test'));
        $this->assertInstanceOf(CreateCategoryEvent::class, $category->getUnCommittedEvent()[0]);
        $this->assertSame('test', $category->getUnCommittedEvent()[0]->getName()->toString());
    }

    public function test_it_edit_category_name()
    {
        $category = Category::create(Name::withName('test'));
        $category->edit(Name::withName('test2'));
        $this->assertInstanceOf(EditCategoryEvent::class, $category->getUnCommittedEvent()[1]);
        $this->assertSame('test2', $category->getUnCommittedEvent()[1]->getName()->toString());
    }

    public function test_it_delete_category_name()
    {
        $category = Category::create(Name::withName('test'));
        $category->delete();
        $this->assertInstanceOf(DeleteCategoryEvent::class, $category->getUnCommittedEvent()[1]);
    }
}
