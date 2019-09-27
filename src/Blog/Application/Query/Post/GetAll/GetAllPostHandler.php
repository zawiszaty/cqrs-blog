<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Post\GetAll;

use App\Blog\Application\Collection;
use App\Blog\Application\QueryHandlerInterface;
use App\Blog\Infrastructure\Post\Repository\Projection\PostFinderInterface;

class GetAllPostHandler implements QueryHandlerInterface
{
    /**
     * @var PostFinderInterface
     */
    private $postFinder;

    public function __construct(PostFinderInterface $postFinder)
    {
        $this->postFinder = $postFinder;
    }

    public function __invoke(GetAllPostQuery $allPostQuery): Collection
    {
        $data = $this->postFinder->getAll($allPostQuery->getPage(), $allPostQuery->getLimit());

        return new Collection(
            $allPostQuery->getPage(),
            $allPostQuery->getLimit(),
            $data->getCount(),
            $data->getData()
        );
    }
}
