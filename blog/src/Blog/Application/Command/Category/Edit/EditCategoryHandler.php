<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class EditCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryStoreRepositoryInterface
     */
    private $categoryStoreRepository;

    public function __construct(CategoryStoreRepositoryInterface $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(EditCategoryCommand $command): void
    {
        $category = $this->categoryStoreRepository->get(AggregateRootId::withId(RamseyUuidAdapter::fromString($command->getId())));
        $category->edit(Name::withName($command->getName()));
        $this->categoryStoreRepository->store($category);
    }
}
