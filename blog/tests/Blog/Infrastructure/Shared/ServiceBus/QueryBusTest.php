<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\ServiceBus;

use PHPUnit\Framework\TestCase;

class TestQuery
{
}

class QueryBusTest extends TestCase
{
    /**
     * @var QueryBus|null
     */
    private $queryBus;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBus = new QueryBus();
        $this->queryBus->addQueryHandler(new TestHandler());
    }

    public function testHandle()
    {
        $this->queryBus->handle(new TestQuery());
        $this->assertSame(1, 1);
    }
}
