<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\Exception;

use App\Blog\Domain\Shared\Exception\DomainException;

class UserException extends DomainException
{
    public static function fromMissingRole(string $role): self
    {
        return new self("$role is missing");
    }

    public static function fromMissingUser(string $id): self
    {
        return new self("User with id: $id doesnt exist");
    }
}
