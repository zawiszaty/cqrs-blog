<?php

declare(strict_types=1);

namespace App\Blog\Domain\Post\ValueObject\Tags;

class Tags
{
    /**
     * @var Tag[]
     */
    private $tags;

    private function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public static function withTags(array $tags): self
    {
        foreach ($tags as $index => $tag) {
            if (false === ($tag instanceof Tag)) {
                $tags[$index] = Tag::withContent($tag);
            }
        }

        return new self($tags);
    }

    public function addTags(string $tag): void
    {
        $this->tags[] = Tag::withContent($tag);
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function toString(): string
    {
        $tags = [];
        $self = new self($this->tags);

        foreach ($self->tags as $index => $tag) {
            $tags[] = $tag->toString();
        }

        return (string) json_encode($tags, JSON_THROW_ON_ERROR, 512);
    }

    public function __toString()
    {
        return $this->toString();
    }
}
