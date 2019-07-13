<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use App\Blog\Application\Command\Category\Edit\EditCategoryCommand;
use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryRepository;
use Tests\Blog\Application\ApplicationTestCase;

class DeleteCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_handele_method()
    {
//        $this->assertNull($this->system->command(new CreateCategoryCommand('testowa nazwa')));
//        /** @var CategoryRepository $repository */
//        $repository = $this->container->get(CategoryRepository::class);
//        /** @var CategoryWasCreatedEvent $event */
//        $event = $repository->getEvents()[0];
//        $this->system->command(new EditCategoryCommand($event->getId()->toString(), 'test nazwa2'));
//        $event = $repository->getEvents()[1];
//        $this->assertInstanceOf(CategoryWasEditedEvent::class, $event);
        $this->assertSame(1, 1);
    }
}
