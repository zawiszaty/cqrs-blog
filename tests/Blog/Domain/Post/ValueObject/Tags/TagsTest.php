<?php

namespace Tests\Blog\Domain\Post\ValueObject\Tags;

use App\Blog\Domain\Post\ValueObject\Tags\Tag;
use App\Blog\Domain\Post\ValueObject\Tags\Tags;
use PHPUnit\Framework\TestCase;

class TagsTest extends TestCase
{
    function test_it_create_tags()
    {
        $tags = Tags::withTags(['test', Tag::withContent('test2')]);
        $this->assertSame(2, count($tags->getTags()));
    }

    function test_it_convert_to_json()
    {
        $tags = Tags::withTags(['test', Tag::withContent('test2')]);
        $this->assertIsString($tags->toString());
        $tags = json_decode($tags->toString());
        $this->assertIsArray($tags);
        $this->assertSame(2, count($tags));
    }
}
