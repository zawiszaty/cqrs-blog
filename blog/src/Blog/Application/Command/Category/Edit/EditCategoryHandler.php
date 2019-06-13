<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\Category\Edit;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EditCategoryHandler implements CommandHandlerInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryStoreRepository;

    public function __construct(CategoryRepository $categoryStoreRepository)
    {
        $this->categoryStoreRepository = $categoryStoreRepository;
    }

    public function __invoke(EditCategoryCommand $command): void
    {
        $category = $this->categoryStoreRepository->find($command->getId());

        if (!$category) {
            throw new NotFoundHttpException();
        }
        $category->edit(Name::withName($command->getName()));
        $this->categoryStoreRepository->apply();
    }
}
