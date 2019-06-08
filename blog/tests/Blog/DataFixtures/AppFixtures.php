<?php

declare(strict_types=1);

namespace Tests\Blog\DataFixtures;

use App\Blog\Infrastructure\Category\Repository\Projection\CategoryView;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; ++$i) {
            $category = new CategoryView(Uuid::uuid4()->toString(), 'test'.$i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
