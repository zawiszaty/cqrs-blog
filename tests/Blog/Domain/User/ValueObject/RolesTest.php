<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\Exception\UserException;
use App\Blog\Domain\User\Role;
use PHPUnit\Framework\TestCase;

class RolesTest extends TestCase
{
    public function test_it_create_roles_with_valid_role()
    {
        $roles = Roles::withRoles([Role::ROLE_USER()]);
        $this->assertSame($roles->getRoles(), [Role::ROLE_USER()->getValue()]);
    }

    public function test_it_create_roles_with_invalid_role()
    {
        $this->expectException(UserException::class);
        Roles::withRoles(['test']);
    }
}
