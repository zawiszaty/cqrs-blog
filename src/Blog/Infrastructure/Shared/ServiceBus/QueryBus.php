<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ServiceBus;

use App\Blog\Application\Collection;
use App\Blog\Application\QueryHandlerInterface;

class QueryBus
{
    /**
     * @var array
     */
    private $queryHandler = [];

    public function addQueryHandler(object $query): void
    {
        $this->queryHandler[\get_class($query)] = $query;
    }

    /**
     * @param object $command
     *
     * @return Collection
     *
     * @throws HandlerNotFoundException
     */
    public function handle(object $command): Collection
    {
        /** @var callable $handler */
        $handler = $this->commandToHandler(\get_class($command));

        return $handler($command);
    }

    /**
     * @param string $command
     *
     * @return QueryHandlerInterface
     *
     * @throws HandlerNotFoundException
     */
    private function commandToHandler(string $command): QueryHandlerInterface
    {
        $queryHandler = explode('\\', $command);
        $queryHandler[count($queryHandler) - 1] = str_replace('Query', 'Handler', $queryHandler[count($queryHandler) - 1]);
        $queryHandler = implode('\\', $queryHandler);
        $handler = $this->queryHandler[$queryHandler];

        if (!$handler instanceof QueryHandlerInterface) {
            throw new HandlerNotFoundException('Handler not found from: '.$command);
        }

        return $handler;
    }
}
