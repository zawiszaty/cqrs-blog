<?php

declare(strict_types=1);

namespace App\Blog\Domain\User\Events;

use App\Blog\Domain\Shared\Infrastructure\Event;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\ValueObject\Roles;

class UserWasCreatedEvent extends Event
{
    /**
     * @var AggregateRootId
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var Roles
     */
    private $roles;

    /**
     * @var string
     */
    private $password;

    /**
     * UserWasCreatedEvent constructor.
     *
     * @param AggregateRootId $id
     * @param string          $username
     * @param Roles           $roles
     * @param string          $password
     */
    public function __construct(AggregateRootId $id, string $username, Roles $roles, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->roles = $roles;
        $this->password = $password;
    }

    /**
     * @return AggregateRootId
     */
    public function getId(): AggregateRootId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return Roles
     */
    public function getRoles(): Roles
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
