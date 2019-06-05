<?php

declare(strict_types=1);

namespace Tests\Blog\Application\Command\Category\Create;

use App\Blog\Application\Command\Category\Create\CreateCategoryCommand;
use Tests\Blog\Application\ApplicationTestCase;
use App\Blog\System;

class CreateCategoryHandlerTest extends ApplicationTestCase
{
    /**
     * @var System
     */
    private $system;

    protected function setUp()
    {
        parent::setUp();
        $this->system = $this->container->get(System::class);
    }

    public function test_it_handele_method()
    {
        $this->assertNull($this->system->command(new CreateCategoryCommand('test')));
    }
}
