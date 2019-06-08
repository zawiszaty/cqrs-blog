<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Event\CreateCategoryEvent;
use App\Blog\Domain\Category\Event\DeleteCategoryEvent;
use App\Blog\Domain\Category\Event\EditCategoryEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MysqlCategoryProjection
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function onCreateCategoryEvent(CreateCategoryEvent $categoryEvent)
    {
        $categoryView = new CategoryView($categoryEvent->getId()->toString(), $categoryEvent->getName()->toString());
        $this->categoryRepository->add($categoryView);
    }

    public function onEditCategoryEvent(EditCategoryEvent $categoryEvent)
    {
        $categoryView = $this->categoryRepository->find($categoryEvent->getId()->toString());

        if (!$categoryView) {
            throw new NotFoundHttpException();
        }
        $categoryView->changeName($categoryEvent->getName()->toString());
        $this->categoryRepository->apply();
    }

    public function onDeleteCategoryEvent(DeleteCategoryEvent $categoryEvent)
    {
        $this->categoryRepository->delete($categoryEvent->getId()->toString());
    }
}
