<?php

namespace spec\App\System;

use App\Command\AddCategoryCommand;
use App\System\System;
use Doctrine\ORM\EntityManager;
use League\Tactician\CommandBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class SystemSpec extends ObjectBehavior
{
    function it_handle_command(EntityManager $entityManager, CommandBus $commandBus, LoggerInterface $logger)
    {
        $this->beConstructedWith($entityManager, $commandBus, $logger);
        $command = new AddCategoryCommand('test');
        $this->handle($command);
    }
}
