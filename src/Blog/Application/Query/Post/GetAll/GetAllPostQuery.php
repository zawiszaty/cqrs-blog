<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Post\GetAll;

class GetAllPostQuery
{
    private $page;

    private $limit;

    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
