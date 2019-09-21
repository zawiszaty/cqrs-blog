<?php


namespace App\Blog\Domain\Post\ValueObject;


class Content
{
    /**
     * @var string
     */
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