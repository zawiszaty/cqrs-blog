<?php

declare(strict_types=1);

namespace Tests\Blog\Infrastructure\Shared\Slugger;

use App\Blog\Infrastructure\Shared\Slugger\Slugger;
use PHPUnit\Framework\TestCase;

class SluggerTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test_it_create_slug(string $text, string $slug)
    {
        $slugger = new Slugger();
        $this->assertSame($slug, $slugger->slugify($text));
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_it_deslugify_slug(string $text, string $slug)
    {
        $slugger = new Slugger();
        $this->assertSame(mb_strtolower($text), $slugger->deSlugify($slug));
    }

    public function dataProvider(): array
    {
        return [
            ['test_test test', 'test|*|test_test'],
            ['test test test', 'test_test_test'],
            ['TEST test test', 'test_test_test'],
            ['test\ test test', 'test\_test_test'],
        ];
    }
}
