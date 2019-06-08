<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Category\Repository\Projection;

use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryRepository extends MysqlRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->class = CategoryView::class;
        parent::__construct($entityManager);
    }

    public function add(CategoryView $postView): void
    {
        $this->register($postView);
    }

    public function delete(string $id): void
    {
        /** @var object $post */
        $post = $this->repository->find($id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function find(string $id): ?CategoryView
    {
        /** @var CategoryView $category */
        $category = $this->repository->find($id);

        return $category;
    }
}
