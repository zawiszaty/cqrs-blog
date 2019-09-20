<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\User\Repository\Projection;

use App\Blog\Domain\Shared\Infrastructure\ORM\ORMAdapterInterface;
use App\Blog\Infrastructure\Shared\ProjectionRepository\MysqlRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends MysqlRepository implements UserRepositoryInterface
{
    public function __construct(ORMAdapterInterface $entityManager)
    {
        $this->class = UserView::class;
        parent::__construct($entityManager);
    }

    public function add(UserView $userView): void
    {
        $this->register($userView);
    }

    public function delete(string $id): void
    {
        $user = $this->find($id);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function find(string $id): UserView
    {
        /** @var UserView|null $user */
        $user = $this->repository->find($id);

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;
    }

    public function findOneBy(array $data): ?UserView
    {
        /** @var UserView|null $userView */
        $userView = $this->repository->findOneBy($data);

        return $userView;
    }
}
