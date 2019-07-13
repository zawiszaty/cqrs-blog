<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\Events\UserWasCreatedEvent;
use App\Blog\Domain\User\ValueObject\Roles;

class User extends AggregateRoot
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var Roles|array
     */
    private $roles;

    /**
     * @var string
     */
    private $password;

    public static function create(string $username, Roles $roles, string $password)
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
