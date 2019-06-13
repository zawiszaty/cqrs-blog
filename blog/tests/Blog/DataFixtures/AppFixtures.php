<?php

declare(strict_types=1);

namespace Tests\Blog\DataFixtures;

use App\Blog\Domain\Category\Category;
use App\Blog\Domain\Shared\Infrastructure\ValueObject\Name;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $category = Category::create(Name::withName("test$i"));
            $manager->persist($category);
        }

        $manager->flush();
    }
}
