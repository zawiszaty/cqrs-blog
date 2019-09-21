<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Category\Exception\CategoryException;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryFinderInterface;

class EditCategoryHandler implements CommandHandlerInterface
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

    public function __invoke(EditCategoryCommand $command): void
    {
        if ($this->checkNameIsUnique($command->getId(), $command->getName())) {
            throw CategoryException::categoryNameExist($command->getName());
        }
        $category = $this->categoryRepository->find(
            AggregateRootId::withId(RamseyUuidAdapter::fromString($command->getId()))
        );
        $category->edit(Name::withName($command->getName()));
        $this->categoryRepository->store($category);
    }

    private function checkNameIsUnique(string $id, string $name): bool
    {
        $category = $this->categoryFinder->findOneByName($name);

        if ($category) {
            if ($category->id === $id) {
                return true;
            }
        }

        return false;
    }
}
