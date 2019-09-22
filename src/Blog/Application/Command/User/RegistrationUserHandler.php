<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\User;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\User\Role;
use App\Blog\Domain\User\Service\PasswordEncoder;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\UserStoreRepositoryInterface;
use App\Blog\Domain\User\ValueObject\Password;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Domain\User\ValueObject\UserName;

class RegistrationUserHandler implements CommandHandlerInterface
{
    /**
     * @var UserStoreRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    public function __construct(UserStoreRepositoryInterface $userRepository, PasswordEncoder $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(RegistrationUserCommand $command): void
    {
        /** @var string $password */
        $password = $this->passwordEncoder->encode($command->getPassword());
        $user = User::create(
            UserName::withUserName($command->getUsername()),
            Roles::withRoles([Role::ROLE_USER()]),
            Password::withPassword($password)
        );
        $this->userRepository->store($user);
    }
}
