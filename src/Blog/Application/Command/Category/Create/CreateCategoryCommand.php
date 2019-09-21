<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

class CreateCategoryCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * CreateCategoryCommand constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
