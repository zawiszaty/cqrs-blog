<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\StoreRepository;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ORM\RedisAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractRedisStoreRepository
{
    /**
     * @var RedisAdapter
     */
    private $redisAdapter;

    protected $className;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(RedisAdapter $redisAdapter, EventDispatcherInterface $eventDispatcher)
    {
        $this->redisAdapter = $redisAdapter;
        $this->eventDispatcher = $eventDispatcher;
    }

    protected function save(AggregateRoot $aggregateRoot): void
    {
        $events = $aggregateRoot->getUnCommittedEvent();
        /** @var Event $event */
        foreach ($events as $event) {
            $this->redisAdapter->hmset(
                $this->computeCategoryHashFor($aggregateRoot->getId()->toString()),
                $event->serialize()
            );
            $this->eventDispatcher->dispatch($event, $event::NAME);
        }
        $aggregateRoot->clearEvent();
    }

    protected function delete(AggregateRoot $aggregateRoot): void
    {
        $this->redisAdapter->del($this->computeCategoryHashFor($aggregateRoot->getId()->toString()));
    }

    public function find(AggregateRootId $aggregateRootId): array
    {
        $data = $this->redisAdapter->hgetall(
            $this->computeCategoryHashFor($aggregateRootId->toString())
        );

        return $data;
    }

    private function computeCategoryHashFor(string $id)
    {
        return sprintf('%s:%s', $this->className, $id);
    }
}
