<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Shared\Infrastructure\ValueObject;

use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function test_it_create_from_string_and_return_valid_name()
    {
        $name = Name::withName('test');
        $this->assertSame($name->toString(), 'test');
    }
}
