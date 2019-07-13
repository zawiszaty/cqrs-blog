<?php

declare(strict_types=1);

namespace Tests\Blog\Application;

use App\Blog\System;
use App\Symfony\Kernel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Tests\Blog\DataFixtures\AppFixtures;

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

    /**
     * @var System
     */
    protected $system;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->kernel = new Kernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
        $this->system = $this->container->get(System::class);
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $loader = new Loader();
        $loader->addFixture(new AppFixtures());
        $purger = new ORMPurger($this->entityManager);
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }
}
