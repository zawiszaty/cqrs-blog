<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

class CategoryView
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    /**
     * @var \DateTime
     */
    public $createdAt;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }
}
