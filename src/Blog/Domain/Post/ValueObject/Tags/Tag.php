<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\ValueObject\Tags;

class Tag
{
    private $tag;

    private function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public static function withContent(string $tagName): self
    {
        return new static($tagName);
    }

    public function toString(): string
    {
        return $this->tag;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
