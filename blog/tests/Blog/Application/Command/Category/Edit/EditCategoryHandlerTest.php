<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Domain\Category\Category;
use App\Blog\System;
use Tests\Blog\Application\ApplicationTestCase;

class EditCategoryHandlerTest extends ApplicationTestCase
{
    /**
     * @var System
     */
    private $system;

    protected function setUp()
    {
        parent::setUp();
        $this->system = $this->container->get(System::class);
    }

    public function test_it_handele_method()
    {
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($this->system->command(new EditCategoryCommand($category->getId()->toString(), 'nowa testowa nazwa')));
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'nowa testowa nazwa']);
        $this->assertNotNull($category);
        $this->assertSame($category->getName()->toString(), 'nowa testowa nazwa');
    }
}
