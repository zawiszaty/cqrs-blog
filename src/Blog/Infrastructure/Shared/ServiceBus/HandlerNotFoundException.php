<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ServiceBus;

class HandlerNotFoundException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
