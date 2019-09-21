<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function test_it_create_password()
    {
        $password = Password::withPassword(password_hash('asdasdasdasdkjashdkjahdkjash', PASSWORD_BCRYPT));
        $this->assertTrue(password_verify('asdasdasdasdkjashdkjahdkjash', $password->toString()));
    }
}
