<?php


namespace App\Blog\Domain\Post\ValueObject;


class Title
{
    /**
     * @var string
     */
    private $title;

    private function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function withTitle(string $title): self
    {
        $title = new self($title);

        return $title;
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