<?php

declare(strict_types=1);

namespace App\Blog\Infrastructure\Shared\Fixtures;

use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use App\Blog\Infrastructure\User\Repository\Projection\UserView;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new UserView(
            Uuid::uuid4()->toString(),
            'test',
            (Roles::withRoles(['ROLE_USER']))->getRoles(),
            '$2y$10$lbPZ4sj72J0dHOVwqYc/9e0RcxLl4cKhVETlmoc8EYsAn4NVnQYOu'
        );
        $manager->persist($user);
        $manager->flush();
    }
}
