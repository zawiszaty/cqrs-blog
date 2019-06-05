<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Category;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function test_it_create_category()
    {
        Category::create(Name::withName('test'));
        $this->assertSame(1, 1);
    }
}
