<?php

declare(strict_types=1);

namespace Tests\Blog\Application\Command\Category\Create;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryRepository;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\Infrastructure\Category\Repository\Store\CategoryStoreRepository;
use Tests\Blog\Application\ApplicationTestCase;

class CreateCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
        $this->assertNull($this->system->command(new CreateCategoryCommand('testowa nazwa')));
        /** @var CategoryRepository $repository */
        $repository = self::$container->get(CategoryStoreRepository::class);
        $event = $repository->getEvents()[0];
        $this->assertInstanceOf(CategoryWasCreatedEvent::class, $event);
        /** @var CategoryView $result */
        $result = $this->entityManager->getRepository(CategoryView::class)->findOneBy([
            'name' => 'testowa nazwa',
        ]);
        $this->assertNotNull($result);
        $this->assertSame('testowa nazwa', $result->name);
    }
}
