<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Processor;

use App\Blog\Domain\Shared\Infrastructure\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProjectionProcessor
{
    /**
     * @var ProcessorConfig
     */
    private $config;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ProcessorConfig $config, ContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    public function process(Event $event): void
    {
        $config = explode(':', $this->config->getConfig(get_class($event)));
        $projection = $this->container->get($config[0]);
        $projection->{$config[1]}($event);
    }
}
