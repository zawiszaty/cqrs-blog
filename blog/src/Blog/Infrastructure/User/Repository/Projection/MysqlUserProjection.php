<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\User\Repository\Projection;

use App\Blog\Domain\User\Events\UserWasCreatedEvent;

class MysqlUserProjection
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserWasCreatedEvent $createdEvent)
    {
        $userView = new UserView(
            $createdEvent->getId()->toString(),
            $createdEvent->getUsername()->toString(),
            $createdEvent->getRoles()->getRoles(),
            $createdEvent->getPassword()->toString()
        );
        $this->userRepository->add($userView);
    }
}
