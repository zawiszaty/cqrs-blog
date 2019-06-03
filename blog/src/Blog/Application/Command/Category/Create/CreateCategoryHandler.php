<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryStoreRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class CreateCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryStoreRepositoryInterface
     */
    private $categoryStoreRepository;

    public function __construct(CategoryStoreRepositoryInterface $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $category = Category::create(Name::withName($command->getName()));
        $this->categoryStoreRepository->store($category);
    }
}
