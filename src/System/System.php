<?php

namespace App\System;

use App\Redis\RedisConnection;
use Doctrine\ORM\EntityManager;
use League\Tactician\CommandBus;
use Psr\Log\LoggerInterface;

/**
 * Class System
 * @package App\System
 */
class System
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var RedisConnection
     */
    private $redisConnection;

    /**
     * System constructor.
     * @param EntityManager $entityManager
     * @param CommandBus $commandBus
     * @param LoggerInterface $logger
     * @param RedisConnection $redisConnection
     */
    public function __construct(EntityManager $entityManager, CommandBus $commandBus, LoggerInterface $logger, RedisConnection $redisConnection)
    {
        $this->entityManager = $entityManager;
        $this->commandBus = $commandBus;
        $this->logger = $logger;
        $this->redisConnection = $redisConnection;
    }

    /**
     * @param Command $command
     * @throws \Exception
     */
    public function handle(Command $command): void
    {
        $this->entityManager->beginTransaction();

        try {
            $this->commandBus->handle($command);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    /**
     * @param string $queryClass
     * @return Query
     */
    public function query(string $queryClass): Query
    {
        $class = new $queryClass($this->redisConnection);

        return $class;
    }
}