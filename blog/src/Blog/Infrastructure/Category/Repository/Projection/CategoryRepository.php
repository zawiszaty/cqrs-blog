<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Category\CategoryRepositoryInterface;
use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryRepository extends MysqlRepository implements CategoryRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = Category::class;
        parent::__construct($entityManager);
    }

    public function add(Category $postView): void
    {
        $this->register($postView);
    }

    public function delete(string $id): void
    {
        $post = $this->find($id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function find(string $id): Category
    {
        /** @var Category|null $category */
        $category = $this->repository->find($id);

        if (!$category) {
            throw new NotFoundHttpException();
        }

        return $category;
    }
}
