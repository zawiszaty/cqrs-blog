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
     * CategoryView constructor.
     *
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
