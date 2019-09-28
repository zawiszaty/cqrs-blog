<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Processor;

use App\Blog\Domain\Shared\Infrastructure\Event;

interface ProjectionProcessorInterface
{
    public function process(Event $event): void;
}
