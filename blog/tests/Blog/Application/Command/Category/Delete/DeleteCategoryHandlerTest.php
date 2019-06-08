<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Domain\Shared\Infrastructure\ORM\RedisAdapter;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\System;
use Tests\Blog\Application\ApplicationTestCase;

class DeleteCategoryHandlerTest extends ApplicationTestCase
{
    /**
     * @var System
     */
    private $system;
    /**
     * @var RedisAdapter
     */
    private $redisAdapter;

    protected function setUp()
    {
        parent::setUp();
        $this->system = $this->container->get(System::class);
        $this->redisAdapter = $this->container->get(RedisAdapter::class);
        $this->redisAdapter->flushall();
    }

    public function test_it_handele_method()
    {
        $this->assertNull($this->system->command(new CreateCategoryCommand('testowa nazwa')));
        $hash = $this->redisAdapter->key('category:*')[0];
        $id = explode(':', $hash);
        $this->assertNull($this->system->command(new DeleteCategoryCommand($id[1])));
        $category = $this->redisAdapter->hgetall($hash);
        $this->assertSame(0, count($category));
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'testowa nazwa']);
        $this->assertNull($category);
    }
}
