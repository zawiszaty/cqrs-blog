<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

interface CategoryFinderInterface
{
    public function getAll(int $page, int $limit): array;

    public function findOneByName(string $name): ?CategoryView;

    public function get(string $id): ?CategoryView;
}
