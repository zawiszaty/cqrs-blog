<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Post\Repository\Projection;

final class PostView
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $tags;

    public function __construct(string $id, string $title, string $content, string $slug, string $tags)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->tags = $tags;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTags(): string
    {
        return $this->tags;
    }
}
