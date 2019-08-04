<?php

declare(strict_types=1);

namespace App\Symfony\DTO;

use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Zawiszaty\App\ArrayDTO;

class CategoryDTO extends ArrayDTO
{
    public function __construct(array $params)
    {
        parent::__construct($params, CategoryView::class);
    }
}
