<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Create;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;

class CreateCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $category = Category::create(Name::withName($command->getName()));
        $this->categoryRepository->add($category);
    }
}
