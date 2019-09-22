<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\Exception\UserException;
use App\Blog\Domain\User\Role;

class Roles
{
    /**
     * @var Role[]
     */
    private $roles;

    private function __construct(array $roles)
    {
        $this->roles = array_unique($roles);
    }

    public static function withRoles(array $roles): Roles
    {
        foreach ($roles as $role) {
            if (false === ($role instanceof Role)) {
                throw UserException::fromMissingRole($role);
            }
        }

        return new self($roles);
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = [];
        foreach ($this->roles as $role) {
            $roles[] = $role->getValue();
        }

        return $roles;
    }
}
