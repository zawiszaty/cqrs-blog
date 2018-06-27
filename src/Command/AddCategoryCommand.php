<?php

namespace App\Command;

use App\System\Command;

/**
 * Class AddCategoryCommand
 * @package App\Command
 */
class AddCategoryCommand implements Command
{
    /**
     * @var string
     */
    private $name;

    /**
     * AddCategoryCommand constructor.
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