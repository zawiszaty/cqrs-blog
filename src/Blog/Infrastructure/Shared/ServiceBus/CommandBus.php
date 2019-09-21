<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ServiceBus;

use App\Blog\Application\CommandHandlerInterface;

class CommandBus
{
    /**
     * @var array
     */
    private $handlers = [];

    /**
     * @param object $command
     *
     * @throws HandlerNotFoundException
     */
    public function handle(object $command): void
    {
        /** @var callable $handler */
        $handler = $this->commandToHandler(\get_class($command));
        $handler($command);
    }

    public function addCommandHandler(object $handler): void
    {
        $this->handlers[\get_class($handler)] = $handler;
    }

    /**
     * @param string $command
     *
     * @return CommandHandlerInterface
     *
     * @throws HandlerNotFoundException
     */
    private function commandToHandler(string $command): CommandHandlerInterface
    {
        $commandHandler = explode('\\', $command);
        $commandHandler[count($commandHandler) - 1] = str_replace('Command', 'Handler', $commandHandler[count($commandHandler) - 1]);
        $commandHandler = implode('\\', $commandHandler);
        $handler = $this->handlers[$commandHandler];

        if (!$handler instanceof CommandHandlerInterface) {
            throw new HandlerNotFoundException('Handler not found from: '.$command);
        }

        return $handler;
    }
}
