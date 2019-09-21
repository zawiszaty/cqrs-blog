<?php

declare(strict_types=1);

namespace Tests\Blog\Application;

use App\Blog\System;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationTestCase extends WebTestCase
{
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
        self::bootKernel();

        $this->system = self::$container->get(System::class);
        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');
        $this->connection = $this->entityManager->getConnection();
        $this->connection->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->connection->rollBack();
    }
}
