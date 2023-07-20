<?php

namespace App\DataFixtures;

use App\Entity\Sale;
use App\Repository\UserRepository;
use App\Repository\StoreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SaleFixtures extends Fixture implements DependentFixtureInterface
{
    private $userRepository;
    private $storeRepository;

    public function __construct(UserRepository $userRepository, StoreRepository $storeRepository)
    {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Récupérer tous les utilisateurs et points de vente
        $sellers = $this->userRepository->findAll();
        $stores = $this->storeRepository->findAll();

        foreach ($sellers as $seller) {
            // Générer un nombre aléatoire de ventes pour chaque vendeur
            $numberOfSales = $faker->numberBetween(5, 30);

            for ($i = 0; $i < $numberOfSales; $i++) {
                $sale = new Sale();

                $sale->setSaleDate($faker->dateTimeBetween('-6 months', 'now'))
                    ->setSeller($seller)
                    ->setRevenue($faker->randomFloat(2, 100, 10000))
                    ->setQuantity($faker->numberBetween(1, 100))
                    ->setPhotoBefore($faker->word . '.jpg')
                    ->setPhotoAfter($faker->word . '.jpg');

                // Générer le nom de fichier du listing
                $listingFile = $faker->word . '.pdf';
                $sale->setListing($listingFile);

                // Associer un point de vente aléatoire à la vente
                $randomStore = $faker->randomElement($stores);
                $sale->setStore($randomStore);

                $manager->persist($sale);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Retourne ici toutes les classes de fixtures dont SaleFixtures dépend
        return [
            StoreFixtures::class,
        ];
    }
}
