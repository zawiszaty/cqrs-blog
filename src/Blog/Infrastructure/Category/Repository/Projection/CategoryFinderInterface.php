<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Infrastructure\Shared\Collection\DataCollection;

interface CategoryFinderInterface
{
    public function getAll(int $page, int $limit): DataCollection;

    public function findOneByName(string $name): ?CategoryView;

    public function get(string $id): ?CategoryView;
}
