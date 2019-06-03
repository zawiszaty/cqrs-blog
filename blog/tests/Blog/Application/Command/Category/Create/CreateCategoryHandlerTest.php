<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

use App\Blog\Infrastructure\Category\Repository\Store\InMemoryCategoryStoreRepository;
use App\Blog\Infrastructure\Shared\ServiceBus\CommandBus;
use PHPUnit\Framework\TestCase;

class CreateCategoryHandlerTest extends TestCase
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var InMemoryCategoryStoreRepository
     */
    private $inMemoryCategoryStoreRepository;

    protected function setUp()
    {
        parent::setUp();
        $this->commandBus = new CommandBus();
        $this->inMemoryCategoryStoreRepository = new InMemoryCategoryStoreRepository();
        $this->commandBus->addCommandHandler(new CreateCategoryHandler($this->inMemoryCategoryStoreRepository));
    }

    public function test_it_handele_method()
    {
        $this->assertNull($this->commandBus->handle(new CreateCategoryCommand('test')));
        $this->assertSame($this->count($this->inMemoryCategoryStoreRepository->getAll()), 1);
    }
}
