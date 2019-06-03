<?php

declare(strict_types=1);

namespace App\Blog;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Application\QueryHandlerInterface;
use App\Blog\Infrastructure\Shared\ServiceBus\CommandBus;
use App\Blog\Infrastructure\Shared\ServiceBus\QueryBus;
use PHPUnit\Framework\TestCase;

class TestHandler implements CommandHandlerInterface, QueryHandlerInterface
{
    public function __invoke(): array
    {
        return [];
    }
}

class TestCommand
{
}

class TestQuery
{
}

class SystemTest extends TestCase
{
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var System
     */
    private $system;
    /**
     * @var QueryBus
     */
    private $queryBus;

    protected function setUp()
    {
        parent::setUp();
        $this->commandBus = new CommandBus();
        $this->queryBus = new QueryBus();
        $this->commandBus->addCommandHandler(new TestHandler());
        $this->queryBus->addQueryHandler(new TestHandler());
        $this->system = new System($this->commandBus, $this->queryBus);
    }

    public function testCommand()
    {
        $this->assertNull($this->system->command(new TestCommand()));
    }

    public function testQuery()
    {
        $this->assertNotNull($this->system->query(new TestQuery()));
    }
}
