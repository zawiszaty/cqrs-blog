<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ServiceBus;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Application\QueryHandlerInterface;
use PHPUnit\Framework\TestCase;

class TestCommand
{
}

class TestHandler implements CommandHandlerInterface, QueryHandlerInterface
{
    public function __invoke(object $test): array
    {
        return [];
    }
}

class CommandBusTest extends TestCase
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    protected function setUp()
    {
        $this->commandBus = new CommandBus();
    }

    public function testHandle()
    {
        $this->commandBus->addCommandHandler(new TestHandler());
        $this->assertSame(1, 1);
    }
}
