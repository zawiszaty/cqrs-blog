<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Tests\Blog\Application\ApplicationTestCase;

class DeleteCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'test1']);
        $this->system->command(new DeleteCategoryCommand($category->id));
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($category);
    }
}
