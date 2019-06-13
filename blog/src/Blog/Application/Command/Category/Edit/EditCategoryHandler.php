<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class EditCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(EditCategoryCommand $command): void
    {
        $category = $this->categoryRepository->find($command->getId());
        $category->edit(Name::withName($command->getName()));
        $this->categoryRepository->apply();
    }
}
