<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Category\GetAll;

class GetAllCategoryQuery
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
