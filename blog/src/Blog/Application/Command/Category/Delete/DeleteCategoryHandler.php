<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

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
        $category = $this->categoryRepository->find(
            AggregateRootId::withId(RamseyUuidAdapter::fromString($command->getId()))
        );
        $category->delete();
        $this->categoryRepository->store($category);
    }
}
