<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryRepository;

class CreateCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryStoreRepository;

    public function __construct(CategoryRepository $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $category = Category::create(Name::withName($command->getName()));
        $this->categoryStoreRepository->add($category);
    }
}
