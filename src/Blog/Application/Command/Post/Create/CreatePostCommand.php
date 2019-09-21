<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Post\Create;

final class CreatePostCommand
{
    /** @var string */
    private $title;
    /** @var string */
    private $content;
    /** @var array */
    private $tags;

    public function __construct(string $title, string $content, array $tags)
    {
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}
