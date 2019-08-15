<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\Events;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\ValueObject\Password;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Domain\User\ValueObject\UserName;

class UserWasCreatedEvent extends Event
{
    /**
     * @var AggregateRootId
     */
    private $id;

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

    public function __construct(AggregateRootId $id, UserName $username, Roles $roles, Password $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->roles = $roles;
        $this->password = $password;
    }

    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    public function getUsername(): UserName
    {
        return $this->username;
    }

    public function getRoles(): Roles
    {
        return $this->roles;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }
}
