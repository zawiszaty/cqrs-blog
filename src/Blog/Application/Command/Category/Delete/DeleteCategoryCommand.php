<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

class DeleteCategoryCommand
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
