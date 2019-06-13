<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryRepositoryInterface;

class DeleteCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        $this->categoryRepository->delete($command->getId());
    }
}
