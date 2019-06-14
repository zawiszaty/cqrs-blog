<?php

declare(strict_types=1);

namespace App\Blog\Domain\User;

use App\Blog\Domain\Shared\Infrastructure\AggregateRoot;
use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\AggregateRootId;
use App\Blog\Domain\User\ValueObject\Roles;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends AggregateRoot implements UserInterface
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

    private function __construct(AggregateRootId $aggregateRootId, string $username, Roles $roles, string $password)
    {
        parent::__construct($aggregateRootId);
        $this->username = $username;
        $this->roles = $roles;
        $this->password = $password;
    }

    public static function create(string $username, Roles $roles, string $password)
    {
        $user = new self(AggregateRootId::withId(RamseyUuidAdapter::generate()), $username, $roles, $password);

        return $user;
    }

    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function getRoles(): array
    {
        if (is_array($this->roles)) {
            return Roles::withRoles($this->roles)->getRoles();
        }

        return $this->roles->getRoles();
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
