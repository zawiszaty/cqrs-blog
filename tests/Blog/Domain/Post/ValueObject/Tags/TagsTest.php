<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\Post\ValueObject\Tags;

use App\Blog\Domain\Post\ValueObject\Tags\Tag;
use App\Blog\Domain\Post\ValueObject\Tags\Tags;
use PHPUnit\Framework\TestCase;

class TagsTest extends TestCase
{
    public function test_it_create_tags(): void
    {
        $tags = Tags::withTags(['test', Tag::withContent('test2')]);
        $this->assertCount(2, $tags->getTags());
    }

    public function test_it_convert_to_json(): void
    {
        $tags = Tags::withTags(['test', Tag::withContent('test2')]);
        $this->assertIsString($tags->toString());
        $tags = json_decode($tags->toString(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertIsArray($tags);
        $this->assertCount(2, $tags);
    }

    public function test_it_add_tag(): void
    {
        $tags = Tags::withTags(['test', Tag::withContent('test2')]);
        $this->assertCount(2, $tags->getTags());
        $tags->addTags('test3');
        $this->assertCount(3, $tags->getTags());
    }
}
