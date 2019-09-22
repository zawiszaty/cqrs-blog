<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Category\GetAll;

use App\Blog\Application\Collection;
use App\Blog\Application\QueryHandlerInterface;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryFinderInterface;

class GetAllCategoryHandler implements QueryHandlerInterface
{
    /**
     * @var CategoryFinderInterface
     */
    private $categoryFinder;

    public function __construct(CategoryFinderInterface $categoryFinder)
    {
        $this->categoryFinder = $categoryFinder;
    }

    public function __invoke(GetAllCategoryQuery $allCategoryQuery): Collection
    {
        $data = $this->categoryFinder->getAll($allCategoryQuery->getPage(), $allCategoryQuery->getLimit());

        return new Collection(
            $allCategoryQuery->getPage(),
            $allCategoryQuery->getLimit(),
            $data->getCount(),
            $data->getData()
        );
    }
}
