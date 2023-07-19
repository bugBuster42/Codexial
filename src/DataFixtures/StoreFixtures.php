<?php

namespace App\DataFixtures;

use App\Entity\Store;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class StoreFixtures extends Fixture
{
    const NUM_STORES = 30;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NUM_STORES; $i++) {
            $store = new Store();
            $store->setName($faker->company);
            $store->setAdress($faker->address);
            $store->setCIP($faker->randomNumber(7));

            $manager->persist($store);
        }

        $manager->flush();
    }
}
