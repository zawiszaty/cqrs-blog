<?php

namespace App\CommandHandler;

use App\Command\AddCategoryCommand;
use App\Command\EditCategoryCommand;
use App\Entity\Category;
use App\Event\AddCategoryEvent;
use App\Event\EditCategoryEvent;
use App\Factory\CategoryFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Runner\Exception;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

/**
 * Class EditCategoryHandler
 * @package App\CommandHandler
 */
class EditCategoryHandler
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
     * @param EditCategoryCommand $editCategoryCommand
     * @throws \Exception
     */
    public function handle(EditCategoryCommand $editCategoryCommand): void
    {
        $category = $this->entityManager->getRepository(Category::class)->find($editCategoryCommand->getId());

        if (!$category)
        {
            throw new \Exception('Not Found', 404);
        }
        $category->changeName($editCategoryCommand->getName());
        $event = new EditCategoryEvent($category->getId(),$category->getName());
        $this->eventDispatcher->dispatch('app.projection.redis.edit_category_projection', $event);
    }
}