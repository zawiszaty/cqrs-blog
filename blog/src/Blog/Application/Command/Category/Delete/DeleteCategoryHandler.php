<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Delete;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;

class DeleteCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryStoreRepositoryInterface
     */
    private $categoryStoreRepository;

    public function __construct(CategoryStoreRepositoryInterface $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        $category = $this->categoryStoreRepository
            ->get(AggregateRootId::withId(RamseyUuidAdapter::fromString($command->getId())));
        $category->delete();
        $this->categoryStoreRepository->remove($category);
    }
}
