<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Category\Exception\CategoryException;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryFinderInterface;

class CreateCategoryHandler implements CommandHandlerInterface
{
    private $categoryRepository;

    private $categoryFinder;

    public function __construct(
        CategoryStoreRepositoryInterface $categoryRepository,
        CategoryFinderInterface $categoryFinder
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFinder = $categoryFinder;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        if ($this->categoryFinder->findOneByName($command->getName())) {
            throw CategoryException::categoryNameExist($command->getName());
        }
        $category = Category::create(Name::withName($command->getName()));
        $this->categoryRepository->store($category);
    }
}
