<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\User\Repository\Store;

use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\UserStoreRepositoryInterface;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Infrastructure\Shared\Processor\ProjectionProcessor;
use App\Blog\Infrastructure\Shared\StoreRepository\StoreRepository;
use App\Blog\Infrastructure\User\Repository\Projection\UserRepositoryInterface;
use App\Blog\Infrastructure\User\Repository\Projection\UserView;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserStoreRepository extends StoreRepository implements UserStoreRepositoryInterface
{
    /**
     * @var ProjectionProcessor
     */
    private $projectionProcessor;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        ProjectionProcessor $projectionProcessor,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct($projectionProcessor);
        $this->userRepository = $userRepository;
    }

    public function find(AggregateRootId $id): User
    {
        /** @var UserView|null $userView */
        $userView = $this->userRepository->find($id->toString());

        if (!$userView) {
            throw new NotFoundHttpException();
        }
        $user = User::withData([
            'id' => AggregateRootId::withId(RamseyUuidAdapter::fromString($userView->getId())),
            'username' => $userView->getUsername(),
            'roles' => Roles::withRoles($userView->getRoles()),
            'password' => $userView->getPassword(),
        ]);

        return $user;
    }

    public function store(User $category): void
    {
        foreach ($category->getUnCommitedEvent() as $event) {
            $this->events[] = $event;
        }
        $this->apply();
    }
}