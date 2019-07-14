<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Tests\Blog\Application\ApplicationTestCase;

class EditCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($this->system->command(new EditCategoryCommand($category->id, 'nowa testowa nazwa')));
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'nowa testowa nazwa']);
        $this->assertNotNull($category);
        $this->assertSame($category->name, 'nowa testowa nazwa');
    }
}
