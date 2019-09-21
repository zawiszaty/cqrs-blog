<?php


namespace App\Blog\Domain\Post\ValueObject\Tags;


class Tags
{
    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * Tags constructor.
     * @param Tag[] $tags
     */
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

    public function addTags(string $tag)
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
        $self =  new self($this->tags);

        foreach ($self->tags as $index => $tag) {
            $self->tags[$index] = $tag->toString();
        }
        return json_encode($self->tags);
    }

    public function __toString()
    {
        return $this->toString();
    }
}