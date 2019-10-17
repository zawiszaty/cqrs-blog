<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

class EditCategoryCommand
{
    private $id;

    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
