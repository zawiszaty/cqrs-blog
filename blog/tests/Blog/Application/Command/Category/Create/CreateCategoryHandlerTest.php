<?php

declare(strict_types=1);

namespace Tests\Blog\Application\Command\Category\Create;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Domain\Category\Category;
use Tests\Blog\Application\ApplicationTestCase;

class CreateCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
        $this->assertNull($this->system->command(new CreateCategoryCommand('testowa nazwa')));
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'testowa nazwa']);
        $this->assertNotNull($category);
        $this->assertSame($category->getName()->toString(), 'testowa nazwa');
    }
}
