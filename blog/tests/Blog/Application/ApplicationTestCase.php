<?php

declare(strict_types=1);

namespace Tests\Blog\Application;

use App\Symfony\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class ApplicationTestCase extends TestCase
{
    /**
     * @var Kernel
     */
    private $kernel;
    /**
     * @var Container
     */
    protected $container;

    protected function setUp()
    {
        parent::setUp();
        $this->kernel = new Kernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
    }
}
