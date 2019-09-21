<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Category\Exception\CategoryException;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryFinderInterface;

class DeleteCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryStoreRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var CategoryFinderInterface
     */
    private $categoryFinder;

    public function __construct(
        CategoryStoreRepositoryInterface $categoryRepository,
        CategoryFinderInterface $categoryFinder
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFinder = $categoryFinder;
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        if (!$this->categoryFinder->get($command->getId())) {
            throw CategoryException::categoryDoesntExist($command->getId());
        }
        $category = $this->categoryRepository->find(
            AggregateRootId::withId(RamseyUuidAdapter::fromString($command->getId()))
        );
        $category->delete();
        $this->categoryRepository->store($category);
    }
}
