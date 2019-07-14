<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Events\CategoryWasCreatedEvent;
use App\Blog\Domain\Category\Events\CategoryWasDeletedEvent;
use App\Blog\Domain\Category\Events\CategoryWasEditedEvent;
use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use Doctrine\ORM\EntityRepository;

class MysqlCategoryProjection
{
    /**
     * @var ORMAdapterInterface
     */
    private $ORMAdapter;
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(ORMAdapterInterface $ORMAdapter)
    {
        $this->ORMAdapter = $ORMAdapter;
        /** @var EntityRepository $repository */
        $repository = $this->ORMAdapter->getRepository(CategoryView::class);
        $this->repository = $repository;
    }

    public function create(CategoryWasCreatedEvent $event): void
    {
        $categoryView = new CategoryView(
            $event->getId()->toString(),
            $event->getName()->toString()
        );
        $this->ORMAdapter->persist($categoryView);
        $this->ORMAdapter->flush();
    }

    public function edit(CategoryWasEditedEvent $event): void
    {
        /** @var CategoryView $category */
        $category = $this->repository->find($event->getId()->toString());
        $category->name = $event->getName()->toString();
        $this->ORMAdapter->flush();
    }

    public function delete(CategoryWasDeletedEvent $event): void
    {
        /** @var CategoryView $category */
        $category = $this->repository->find($event->getId()->toString());
        $this->ORMAdapter->remove($category);
        $this->ORMAdapter->flush();
    }
}
