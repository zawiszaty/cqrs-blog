<?php

declare(strict_types=1);

namespace App\Blog;

use App\Blog\Application\Collection;
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

    public function command(object $command): void
    {
        $this->commandBus->handle($command);
    }

    public function query(object $query): Collection
    {
        return $this->queryBus->handle($query);
    }
}
