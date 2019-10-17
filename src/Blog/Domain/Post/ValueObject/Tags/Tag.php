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

    public static function withContent(string $tag): self
    {
        $tag = new self($tag);

        return $tag;
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
