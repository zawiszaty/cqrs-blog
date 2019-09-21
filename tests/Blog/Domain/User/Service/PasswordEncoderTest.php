<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\User\Service;

use App\Blog\Domain\User\Service\PasswordEncoder;
use PHPUnit\Framework\TestCase;

class PasswordEncoderTest extends TestCase
{
    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    protected function setUp()
    {
        parent::setUp();
        $this->passwordEncoder = new PasswordEncoder();
    }

    /**
     * @dataProvider passwordDataProvider
     */
    public function test_it_hash_password_and_verify(string $password)
    {
        $hashedPassword = $this->passwordEncoder->encode('test');
        $this->assertIsString($password);
        $this->assertTrue($this->passwordEncoder->verify($password, $hashedPassword));
    }

    public function passwordDataProvider(): array
    {
        return [
            ['test'],
        ];
    }
}
