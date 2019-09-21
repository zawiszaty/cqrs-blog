<?php


namespace App\Blog\Domain\Post;


use App\Blog\Domain\Post\Event\PostWasCreatedEvent;
use App\Blog\Domain\Post\ValueObject\Content;
use App\Blog\Domain\Post\ValueObject\Tags\Tags;
use App\Blog\Domain\Post\ValueObject\Title;
use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class Post extends AggregateRoot
{
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


    public static function create(string $title, string $content, array $tags): self
    {
        $self = new self();
        $self->record(
            new PostWasCreatedEvent(
                AggregateRootId::withId(RamseyUuidAdapter::generate()),
                Content::withContent($content),
                Title::withTitle($title),
                Tags::withTags($tags))
        );

        return $self;
    }

    public function apply(Event $event): void
    {
        if ($event instanceof PostWasCreatedEvent) {
            $this->applyPostWasCreatedEvent($event);
        }
    }

    private function applyPostWasCreatedEvent(PostWasCreatedEvent $event)
    {
        $this->id = $event->getId();
        $this->content = $event->getContent();
        $this->title = $event->getTitle();
        $this->tags = $event->getTags();
    }
}