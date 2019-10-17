<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\Event;

use App\Blog\Domain\Post\ValueObject\Content;
use App\Blog\Domain\Post\ValueObject\Tags\Tags;
use App\Blog\Domain\Post\ValueObject\Title;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class PostWasCreatedEvent extends Event
{
    private $id;

    private $content;

    private $title;

    private $tags;

    public function __construct(AggregateRootId $id, Content $content, Title $title, Tags $tags)
    {
        $this->id = $id;
        $this->content = $content;
        $this->title = $title;
        $this->tags = $tags;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getTags(): Tags
    {
        return $this->tags;
    }

    public function getId(): AggregateRootId
    {
        return $this->id;
    }
}
