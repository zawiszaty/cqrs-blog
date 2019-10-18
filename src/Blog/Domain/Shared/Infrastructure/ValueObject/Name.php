<?php

declare(strict_types=1);

namespace App\Blog\Domain\Shared\Infrastructure\ValueObject;

class Name
{
    /**
     * @var string
     */
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function withName(string $nameValue): self
    {
        return new self($nameValue);
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
