<?php

declare(strict_types=1);

namespace Tests\Blog\DataFixtures;

use App\Blog\Domain\Shared\Infrastructure\Uuid\RamseyUuidAdapter;
use App\Blog\Domain\User\User;
use App\Blog\Domain\User\ValueObject\Roles;
use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $category = new CategoryView(RamseyUuidAdapter::generate()->toString(), "test$i");
            $manager->persist($category);
        }
//        $user = User::create(
//            'test',
//            Roles::withRoles(['ROLE_USER']),
//            '$2y$13$het2dX9tQxNwEGdT1HSzQOm1biWAkxLKAHNvnqV62/ffpoqUqgzx2'
//        );
//        $manager->persist($user);
        $manager->flush();
    }
}
