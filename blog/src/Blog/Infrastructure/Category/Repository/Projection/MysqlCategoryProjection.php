<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasDeletedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
use App\Blog\Infrastructure\Category\Repository\CategoryRepositoryInterface;

class MysqlCategoryProjection
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(CategoryWasCreatedEvent $event): void
    {
        $categoryView = new CategoryView(
            $event->getId()->toString(),
            $event->getName()->toString()
        );
        $this->categoryRepository->store($categoryView);
    }

    public function edit(CategoryWasEditedEvent $event): void
    {
        /** @var CategoryView $category */
        $category = $this->categoryRepository->find($event->getId());
        $category->name = $event->getName()->toString();
        $this->categoryRepository->apply();
    }

    public function delete(CategoryWasDeletedEvent $event): void
    {
        /** @var CategoryView $category */
        $category = $this->categoryRepository->find($event->getId());
        $this->categoryRepository->remove($category);
        $this->categoryRepository->apply();
    }
}
