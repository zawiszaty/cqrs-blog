<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Store;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Category\Exception\CategoryException;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\CategoryRepositoryInterface;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessorInterface;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClient;
use App\Blog\Infrastructure\Shared\Rabbitmq\RabbitmqClientInterface;
use App\Blog\Infrastructure\Shared\StoreRepository\StoreRepository;

class CategoryStoreRepository extends StoreRepository implements CategoryStoreRepositoryInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(ProjectionProcessorInterface $projectionProcessor, CategoryRepositoryInterface $categoryRepository, RabbitmqClientInterface $client)
    {
        parent::__construct($projectionProcessor, $client);
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
            throw CategoryException::categoryDoesntExist($id->toString());
        }
        $category = Category::withData([
            'id' => AggregateRootId::withId(RamseyUuidAdapter::fromString($categoryView->id)),
            'name' => Name::withName($categoryView->name),
        ]);

        return $category;
    }
}
