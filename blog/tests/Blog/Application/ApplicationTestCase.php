<?php

declare(strict_types=1);

namespace Tests\Blog\Application;

use App\Blog\System;
use App\Symfony\Kernel;
use Doctrine\ORM\EntityManager;
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

    /**
     * @var System
     */
    protected $system;
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var \Doctrine\DBAL\Connection|object
     */
    private $connection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->kernel = new Kernel('test', true);
        $this->kernel->boot();
        $this->container = $this->kernel->getContainer();
        $this->system = $this->container->get(System::class);
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->connection = $this->entityManager->getConnection();
        $this->connection->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->connection->rollBack();
    }
}
