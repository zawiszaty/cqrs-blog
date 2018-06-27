<?php

namespace App\CommandHandler;

use App\Command\AddCategoryCommand;
use App\Event\AddCategoryEvent;
use App\Factory\CategoryFactory;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

/**
 * Class AddCategoryHandler
 * @package App\CommandHandler
 */
class AddCategoryHandler
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var TraceableEventDispatcher
     */
    private $eventDispatcher;

    /**
     * AddCategoryHandler constructor.
     * @param EntityManager $entityManager
     * @param TraceableEventDispatcher $eventDispatcher
     */
    public function __construct(EntityManager $entityManager, TraceableEventDispatcher $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param AddCategoryCommand $addCategoryCommand
     * @throws \Doctrine\ORM\ORMException
     */
    public function handle(AddCategoryCommand $addCategoryCommand): void
    {
        $category = CategoryFactory::create($addCategoryCommand->getName());
        $event = new AddCategoryEvent($category->getId(), $category->getName());
        $this->eventDispatcher->dispatch('app.projection.redis.add_category_projection', $event);
        $this->entityManager->persist($category);
    }
}