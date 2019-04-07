<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;

use App\Entity\Bien;

class BienFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for( $i = 0; $i < 100; $i++){
            $bien = new Bien();
            $bien->setNom($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(40, 500))
                ->setPieces($faker->numberBetween(2, 10))
                ->setChambres($faker->numberBetween(1, 9))
                ->setEtage($faker->numberBetween(0, 5))
                ->setPrix($faker->numberBetween(100000,50000000))
                ->setClimatisation($faker->numberBetween(1, count(Bien::CLIMATISATION) - 1))
                ->setVille($faker->city)
                ->setAdresse($faker->address)
                ->setVendu(false);
            $manager->persist($bien);
        }

        $manager->flush();
    }
}

