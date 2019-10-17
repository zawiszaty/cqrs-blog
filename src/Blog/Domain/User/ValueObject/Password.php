<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use Assert\Assertion;

class Password
{
    private $password;

    private function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function withPassword(string $password): self
    {
        Assertion::string($password, 'Password must be string');
        Assertion::length($password, 60, 'Password must be hash');
        $self = new self($password);

        return $self;
    }

    public function toString()
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return $this->password;
    }
}
