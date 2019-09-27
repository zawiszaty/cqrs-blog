<?php
declare(strict_types=1);


namespace App\Blog\Infrastructure\Post\Repository\Projection;


use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\Infrastructure\Shared\Collection\DataCollection;

interface PostFinderInterface
{
    public function getAll(int $page, int $limit): DataCollection;

    public function findOneByName(string $name): ?PostView;

    public function get(string $id): ?PostView;
}