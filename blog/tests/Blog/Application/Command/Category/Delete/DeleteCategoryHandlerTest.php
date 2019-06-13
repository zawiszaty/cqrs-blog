<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Domain\Category\Category;
use App\Blog\System;
use Tests\Blog\Application\ApplicationTestCase;

class DeleteCategoryHandlerTest extends ApplicationTestCase
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
        $this->assertNull($this->system->command(new DeleteCategoryCommand($category->getId()->toString())));
        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['name' => 'test1']);
        $this->assertNull($category);
    }
}
