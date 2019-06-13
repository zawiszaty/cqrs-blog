<?php

declare(strict_types=1);

namespace App\Blog\Domain\Category;

interface CategoryFinderInterface
{
    public function getAll(int $page, int $limit): array;
}
