<?php

namespace App\Command;

use App\System\Command;

class DeleteCategoryCommand implements Command
{
    /**
     * @var string
     */
    private $id;

    /**
     * DeleteCategoryCommand constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}