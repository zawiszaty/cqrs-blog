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

    public static function withName(string $name): self
    {
        $name = new self($name);

        return $name;
    }

    public function toString(): string
    {
        return $this->name;
    }
}
