<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\Exception\RoleNotFoundException;
use App\Blog\Domain\User\Role;

class Roles
{
    /**
     * @var array
     */
    private $roles;

    private function __construct(array $roles)
    {
        $this->roles = array_unique($roles);
    }

    public static function withRoles(array $roles): Roles
    {
        foreach ($roles as $role) {
            switch ($role) {
                case Role::User == $role:
                    break;
                default:
                    throw new RoleNotFoundException();
                    break;
            }
        }

        return new self($roles);
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
