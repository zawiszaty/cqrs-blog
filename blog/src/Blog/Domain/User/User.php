<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\Events\UserWasCreatedEvent;
use App\Blog\Domain\User\ValueObject\Password;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Domain\User\ValueObject\UserName;

class User extends AggregateRoot
{
    /**
     * @var UserName
     */
    private $username;

    /**
     * @var Roles
     */
    private $roles;

    /**
     * @var Password
     */
    private $password;

    public static function create(UserName $username, Roles $roles, Password $password)
    {
        $user = new self();
        $user->record(
            new UserWasCreatedEvent(
                AggregateRootId::withId(RamseyUuidAdapter::generate()),
                $username,
                $roles,
                $password
            )
        );

        return $user;
    }

    public static function withData(array $data): self
    {
        $user = new self();
        $user->id = $data['id'];
        $user->username = $data['username'];
        $user->roles = $data['roles'];
        $user->password = $data['password'];

        return $user;
    }

    public function apply(Event $event): void
    {
        if ($event instanceof UserWasCreatedEvent) {
            $this->id = $event->getId();
            $this->username = $event->getUsername();
            $this->password = $event->getPassword();
            $this->roles = $event->getRoles();
        }
    }
}
