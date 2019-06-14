<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\Exception\RoleNotFoundException;
use App\Blog\Domain\User\Role;
use PHPUnit\Framework\TestCase;

class RolesTest extends TestCase
{
    public function test_it_create_roles_wtih_valid_role()
    {
        $roles = Roles::withRoles([Role::User]);
        $this->assertSame($roles->getRoles(), [Role::User]);
    }

    public function test_it_create_roles_wtih_in_valid_role()
    {
        $this->expectException(RoleNotFoundException::class);
        Roles::withRoles(['test']);
    }
}
