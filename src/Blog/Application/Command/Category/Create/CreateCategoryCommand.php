<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

class CreateCategoryCommand
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
