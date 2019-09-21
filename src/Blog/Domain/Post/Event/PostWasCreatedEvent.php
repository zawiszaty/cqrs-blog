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
    /**
     * @var AggregateRootId
     */
    private $id;
    /**
     * @var Content
     */
    private $content;

    /**
     * @var Title
     */
    private $title;

    /**
     * @var Tags
     */
    private $tags;

    /**
     * PostWasCreatedEvent constructor.
     *
     * @param AggregateRootId $id
     * @param Content         $content
     * @param Title           $title
     * @param Tags            $tags
     */
    public function __construct(AggregateRootId $id, Content $content, Title $title, Tags $tags)
    {
        $this->id = $id;
        $this->content = $content;
        $this->title = $title;
        $this->tags = $tags;
    }

    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }

    /**
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @return Tags
     */
    public function getTags(): Tags
    {
        return $this->tags;
    }

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }
}
