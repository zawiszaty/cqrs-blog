<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessor;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryRepository extends MysqlRepository implements CategoryRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager, ProjectionProcessor $projectionProcessor)
    {
        $this->class = CategoryView::class;
        parent::__construct($entityManager, $projectionProcessor);
    }

    public function store(Category $category): void
    {
        foreach ($category->getUnCommitedEvent() as $event) {
            $this->events[] = $event;
        }
        $this->apply();
    }

    public function find(AggregateRootId $id): Category
    {
        /** @var CategoryView|null $categoryView */
        $categoryView = $this->repository->find($id);

        if (!$categoryView) {
            throw new NotFoundHttpException();
        }
        $category = Category::withData([
           'id' => AggregateRootId::withId(RamseyUuidAdapter::fromString($categoryView->id)),
           'name' => Name::withName($categoryView->name),
        ]);

        return $category;
    }
}
