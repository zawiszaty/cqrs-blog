<?php

namespace App\Factory;

use App\Entity\Category;
use Ramsey\Uuid\Uuid;

/**
 * Class CategoryFactory
 * @package Factory
 */
class CategoryFactory
{
    /**
     * @param string $name
     * @return Category
     */
    public static function create(string $name): Category
    {
        $category = new Category(Uuid::uuid4()->toString(), $name, 0);

        return $category;
    }
}
