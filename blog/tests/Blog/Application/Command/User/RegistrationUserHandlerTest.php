<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\User;

use App\Blog\Domain\User\User;
use Tests\Blog\Application\ApplicationTestCase;

class RegistrationUserHandlerTest extends ApplicationTestCase
{
    public function test_invoke()
    {
        $this->assertNull($this->system->command(new RegistrationUserCommand(
            'test user',
            'test',
            'test'
        )));
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'test user']);
        $this->assertNotNull($user);
        $this->assertSame($user->getUsername(), 'test user');
    }
}
