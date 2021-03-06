<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\ValueObject;

use Assert\Assertion;

class UserName
{
    /** @var string */
    private $username;

    private function __construct(string $username)
    {
        $this->username = $username;
    }

    public static function withUserName(string $name): self
    {
        Assertion::string($name, 'Name must be string');
        Assertion::notEq($name, '', 'Name must be not a empty string');

        return new self($name);
    }

    public function toString()
    {
        return (string) $this;
    }

    public function __toString()
    {
        return $this->username;
    }
}
