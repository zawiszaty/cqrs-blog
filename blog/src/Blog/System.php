<?php


namespace App\Blog;


use App\Blog\Infrastructure\Shared\ServiceBus\CommandBus;
use App\Blog\Infrastructure\Shared\ServiceBus\QueryBus;

class System
{
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var QueryBus
     */
    private $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }
}