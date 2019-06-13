<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryRepository;

class DeleteCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryStoreRepository;

    public function __construct(CategoryRepository $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        $this->categoryStoreRepository->delete($command->getId());
    }
}
