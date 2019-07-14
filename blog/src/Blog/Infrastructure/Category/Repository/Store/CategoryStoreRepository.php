<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Store;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\CategoryRepositoryInterface;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessor;
use App\Blog\Infrastructure\Shared\StoreRepository\StoreRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryStoreRepository extends StoreRepository implements CategoryStoreRepositoryInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(ProjectionProcessor $projectionProcessor, CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($projectionProcessor);
        $this->categoryRepository = $categoryRepository;
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
        $categoryView = $this->categoryRepository->find($id);

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
