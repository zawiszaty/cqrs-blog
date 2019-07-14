<?php

declare(strict_types=1);

namespace App\Blog\Application\Query\Category\GetAll;

use App\Blog\Application\Collection;
use Tests\Blog\Application\ApplicationTestCase;

class GetAllCategoryHandlerTest extends ApplicationTestCase
{
    public function test_it_invoke()
    {
        /** @var Collection $data */
        $data = $this->system->query(new GetAllCategoryQuery(1, 10));
        $this->assertNotNull($data);
        $this->assertSame($data->page, 1);
        $this->assertSame($data->limit, 10);
        $this->assertSame($data->total, 20);
    }
}
