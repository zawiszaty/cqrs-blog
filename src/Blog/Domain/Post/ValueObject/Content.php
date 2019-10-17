<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\ValueObject;

class Content
{
    private $content;

    private function __construct(string $content)
    {
        $this->content = $content;
    }

    public static function withContent(string $name): self
    {
        $name = new self($name);

        return $name;
    }

    public function toString(): string
    {
        return $this->content;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
