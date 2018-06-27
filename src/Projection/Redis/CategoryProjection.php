<?php

namespace App\Projection\Redis;

use App\Event\AddCategoryEvent;
use App\Event\DeleteCategoryEvent;
use App\Event\EditCategoryEvent;
use Predis\Client;

class CategoryProjection
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client('tcp://cqrs-blog-redis:6379');
    }

    /**
     * @param AddCategoryEvent $addCategoryEvent
     */
    public function onAddCategoryEvent(AddCategoryEvent $addCategoryEvent): void
    {
        $hash = $this->computeCategoryHashFor($addCategoryEvent->getId());
        $this->client->hmset($hash, [
            "id" => $addCategoryEvent->getId(),
            "name" => $addCategoryEvent->getName(),
            "deleted" => 0
        ]);
        $this->client->rpush('category', $hash);
    }

    /**
     * @param string $id
     * @return string
     */
    protected function computeCategoryHashFor(string $id)
    {
        return sprintf('category:%s', $id);
    }

    /**
     * @param EditCategoryEvent $editCategoryEvent
     */
    public function onEditCategoryEvent(EditCategoryEvent $editCategoryEvent):void
    {
        $hash = $this->computeCategoryHashFor($editCategoryEvent->getId());
        $this->client->hmset($hash, [
            "id" => $editCategoryEvent->getId(),
            "name" => $editCategoryEvent->getName(),
            "deleted" => 0
        ]);
    }

    /**
     * @param DeleteCategoryEvent $deleteCategoryEvent
     */
    public function onDeleteCategoryEvent(DeleteCategoryEvent $deleteCategoryEvent):void
    {
        $hash = $this->computeCategoryHashFor($deleteCategoryEvent->getId());
        $this->client->hset($hash,'deleted', 1);
    }
}