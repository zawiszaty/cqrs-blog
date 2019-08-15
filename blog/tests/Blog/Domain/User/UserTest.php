<?php

declare(strict_types=1);

namespace Tests\Blog\Domain\User;

use App\Blog\Domain\User\Events\UserWasCreatedEvent;
use App\Blog\Domain\User\Role;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\ValueObject\Password;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Domain\User\ValueObject\UserName;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UserTest extends TestCase
{
    public function testItCreateUser()
    {
        $user = User::create(UserName::withUserName('test'), Roles::withRoles([Role::User]), Password::withPassword(password_hash('test', PASSWORD_DEFAULT)));
        /** @var UserWasCreatedEvent $event */
        $event = $user->getUnCommitedEvent()[0];
        $this->assertInstanceOf(UserWasCreatedEvent::class, $event);
        $this->assertSame($event->getUsername()->toString(), 'test');
        $this->assertSame($event->getRoles()->getRoles(), [Role::User]);
        $this->assertTrue(password_verify('test', $event->getPassword()->toString()));
    }
}
