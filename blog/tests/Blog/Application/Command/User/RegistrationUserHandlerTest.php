<?php

declare(strict_types=1);

namespace App\Blog\Application\Command\User;

use App\Blog\Infrastructure\User\Repository\Projection\UserView;
use Tests\Blog\Application\ApplicationTestCase;

class RegistrationUserHandlerTest extends ApplicationTestCase
{
    public function test_invoke()
    {
        $this->assertNull($this->system->command(new RegistrationUserCommand(
            'test nazwa',
            'test'
        )));
        /** @var UserView $result */
        $result = $this->entityManager->getRepository(UserView::class)->findOneBy([
            'username' => 'test nazwa',
        ]);
        $this->assertNotNull($result);
        $this->assertSame('test nazwa', $result->getUsername());
    }
}
