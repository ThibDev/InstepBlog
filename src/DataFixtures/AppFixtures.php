<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@gmail.com')->setPassword('admin');
        $adminUser = new User();
        $adminUser->setEmail('admin@gmail.com')->setPassword('admin');

        $manager->flush();
    }
}
