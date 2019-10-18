<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\ValueObject;

class Title
{
    private $title;

    private function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function withTitle(string $titleValue): self
    {
        return new self($titleValue);
    }

    public function toString(): string
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
