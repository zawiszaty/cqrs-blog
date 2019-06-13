<?php

declare(strict_types=1);

namespace Tests\Blog\DataFixtures;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use App\Blog\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $category = Category::create(Name::withName("test$i"));
            $manager->persist($category);
        }
        $user = new User();
        $user->setId(Uuid::uuid4()->toString());
        $user->setUsername('test');
        $user->setPassword('$2y$13$het2dX9tQxNwEGdT1HSzQOm1biWAkxLKAHNvnqV62/ffpoqUqgzx2');
        $manager->persist($user);
        $manager->flush();
    }
}
