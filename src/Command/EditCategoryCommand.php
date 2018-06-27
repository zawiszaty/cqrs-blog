<?php

namespace App\Command;

use App\System\Command;

/**
 * Class EditCategoryCommand
 * @package App\Command
 */
class EditCategoryCommand implements Command
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * EditCategoryCommand constructor.
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id,string $name)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}