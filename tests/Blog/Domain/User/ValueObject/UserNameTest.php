<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\User\ValueObject;

use App\Blog\Domain\User\ValueObject\UserName;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserNameTest extends TestCase
{
    public function test_it_create_valid_username()
    {
        $username = UserName::withUserName('test');
        $this->assertSame('test', $username->toString());
    }

    public function test_it_throw_exception_when_is_empty_username()
    {
        $this->expectException(InvalidArgumentException::class);
        UserName::withUserName('');
    }
}
