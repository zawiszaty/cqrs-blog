<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure;

interface Event
{
    public function serialize(): array;
}
