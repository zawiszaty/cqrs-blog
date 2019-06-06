<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure;

abstract class Event
{
    abstract public function serialize(): array;
}
