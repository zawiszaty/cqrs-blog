<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class DeleteCategoryEvent extends Event
{
    /**
     * @var string
     */
    private $id;

    /**
     * DeleteCategoryEvent constructor.
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