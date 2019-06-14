<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\User\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\UserRepositoryInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends MysqlRepository implements UserRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = User::class;
        parent::__construct($entityManager);
    }

    public function add(User $postView): void
    {
        $this->register($postView);
    }

    public function delete(string $id): void
    {
        $post = $this->find($id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

    public function find(string $id): User
    {
        /** @var User|null $user */
        $user = $this->repository->find($id);

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;
    }
}
