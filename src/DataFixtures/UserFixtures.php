<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $admin = new User();
        $admin->setEmail('audelavalade@codexial.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setLastname('Lavalade');
        $admin->setFirstname('Aude');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpassword'));
        $manager->persist($admin);

        $fixedSeller = new User();
        $fixedSeller->setEmail('jordanbelfort@codexial.com');
        $fixedSeller->setRoles(['ROLE_USER']);
        $fixedSeller->setLastname('Belfort');
        $fixedSeller->setFirstname('Jordan');
        $fixedSeller->setPassword($this->passwordHasher->hashPassword($fixedSeller, 'azertyuiop'));
        $manager->persist($fixedSeller);

        for ($i = 0; $i < 30; $i++) {
            $seller = new User();
            $seller->setEmail($faker->email);
            $seller->setRoles(['ROLE_USER']);
            $seller->setLastname($faker->lastName);
            $seller->setFirstname($faker->firstName);
            $seller->setPassword($this->passwordHasher->hashPassword($seller, $faker->password));
            $manager->persist($seller);
        }


        $manager->flush();
    }
}
