<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Slugger;

final class Slugger
{
    private const SEPARATOR = '_';

    public function slugify(string $text): string
    {
        $text = mb_strtolower($text);
        if (false !== strstr($text, self::SEPARATOR)) {
            $text = str_replace(self::SEPARATOR, '|*|', $text);
        }
        $text = str_replace(' ', self::SEPARATOR, $text);

        return $text;
    }

    public function deSlugify(string $slug): string
    {
        $text = str_replace(self::SEPARATOR, ' ', $slug);
        $text = str_replace('|*|', self::SEPARATOR, $text);

        return $text;
    }
}
