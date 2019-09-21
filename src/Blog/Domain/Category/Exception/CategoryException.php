<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category\Exception;

class CategoryException extends \DomainException
{
    public static function categoryNameExist(string $name): self
    {
        return new self("Name $name exist");
    }

    public static function categoryDoesntExist(string $id): self
    {
        return new self("Category with id $id doesnt exist");
    }
}
