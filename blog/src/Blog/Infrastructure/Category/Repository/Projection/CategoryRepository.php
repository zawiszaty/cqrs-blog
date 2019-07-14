<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Category\Repository\CategoryRepositoryInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;

class CategoryRepository extends MysqlRepository implements CategoryRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = CategoryView::class;
        parent::__construct($entityManager);
    }

    public function store(CategoryView $category): void
    {
        $this->register($category);
        $this->apply();
    }

    public function find(AggregateRootId $id): CategoryView
    {
        /** @var CategoryView $categoryView */
        $categoryView = $this->repository->find($id->toString());

        return $categoryView;
    }

    public function remove(CategoryView $category): void
    {
        $this->entityManager->remove($category);
    }
}
