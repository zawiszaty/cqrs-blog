<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\User;

use App\Blog\Application\CommandHandlerInterface;
use App\Blog\Domain\User\Role;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\UserStoreRepositoryInterface;
use App\Blog\Domain\User\ValueObject\Password;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Domain\User\ValueObject\UserName;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationUserHandler implements CommandHandlerInterface
{
    /**
     * @var UserStoreRepositoryInterface
     */
    private $userRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserStoreRepositoryInterface $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(RegistrationUserCommand $command): void
    {
        /** @var string $password */
        $password = password_hash($command->getPassword(), PASSWORD_BCRYPT);
        $user = User::create(
            UserName::withUserName($command->getUsername()),
            Roles::withRoles([Role::User]),
            Password::withPassword($password)
        );
        $this->userRepository->store($user);
    }
}
