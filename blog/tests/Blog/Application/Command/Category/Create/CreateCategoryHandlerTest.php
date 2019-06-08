<?php

declare(strict_types=1);

namespace Tests\Blog\Application\Command\Category\Create;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Domain\Shared\Infrastructure\ORM\RedisAdapter;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Tests\Blog\Application\ApplicationTestCase;
use App\Blog\System;

class CreateCategoryHandlerTest extends ApplicationTestCase
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
        $category = $this->redisAdapter->hgetall($this->redisAdapter->key('category:*')[0]);
        $this->assertSame($category['name'], 'testowa nazwa');
        /** @var CategoryView $category */
        $category = $this->entityManager->getRepository(CategoryView::class)->findOneBy(['name' => 'testowa nazwa']);
        $this->assertNotNull($category);
        $this->assertSame($category->getName(), 'testowa nazwa');
    }
}
