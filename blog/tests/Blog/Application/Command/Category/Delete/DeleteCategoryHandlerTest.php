<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Domain\Category\Category;
use Tests\Blog\Application\ApplicationTestCase;

class DeleteCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($this->system->command(new DeleteCategoryCommand($category->getId()->toString())));
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($category);
    }
}
