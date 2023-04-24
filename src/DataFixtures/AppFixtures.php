<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $encoder;

    private function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@gmail.com')->setPassword($this->encoder->hashPassword($user, 'test'));
        $manager->persist($user);

        $adminUser = new User();
        $adminUser->setEmail('admin@gmail.com')->setRoles(["ROLE_ADMIN"])->setPassword($this->encoder->hashPassword($adminUser, 'admin'));
        $manager->persist($adminUser);

        $manager->flush();
    }
}
