<?php

namespace App\CommandHandler;

use App\Command\AddCategoryCommand;
use App\Command\DeleteCategoryCommand;
use App\Command\EditCategoryCommand;
use App\Entity\Category;
use App\Event\AddCategoryEvent;
use App\Event\DeleteCategoryEvent;
use App\Event\EditCategoryEvent;
use App\Factory\CategoryFactory;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

/**
 * Class EditCategoryHandler
 * @package App\CommandHandler
 */
class DeleteCategoryHandler
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
     * EditCategoryHandler constructor.
     * @param EntityManager $entityManager
     * @param TraceableEventDispatcher $eventDispatcher
     */
    public function __construct(EntityManager $entityManager, TraceableEventDispatcher $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param DeleteCategoryCommand $deleteCategoryCommand
     */
    public function handle(DeleteCategoryCommand $deleteCategoryCommand): void
    {
        $category = $this->entityManager->getRepository(Category::class)->find($deleteCategoryCommand->getId());
        $category->delete();
        $event = new DeleteCategoryEvent($category->getId());
        $this->eventDispatcher->dispatch('app.projection.redis.delete_category_projection', $event);
    }
}