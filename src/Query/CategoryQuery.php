<?php

namespace App\Query;

use App\Query\View\CategoryView;

/**
 * Interface CategoryQuery
 * @package App\Query
 */
interface CategoryQuery
{
    /**
     * @return array
     */
    public function getAll(): array ;

    /**
     * @param string $id
     * @return CategoryView
     */
    public function get(string $id): CategoryView;
}

