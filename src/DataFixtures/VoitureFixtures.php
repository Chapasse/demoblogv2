<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Voiture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($j=0; $j < 3; $j++) 
        { 
            $type = new Type;
            $titres= array('coupé', 'suv', '4x4');
            $key=array_rand($titres);
            $type->setTitre($titres[$key]);
            $type->setNbRoues(4,6);

            $manager->persist($type);
            
            for($i = 1; $i <= 15; $i++)
            {
                $prix = rand(1000, 100000) ;
                $voiture = new Voiture;
                $voiture->setMarque($faker->sentence(1,true))
                ->setModele($faker->sentence(1,true))
                ->setType($type)
                ->setPrix($prix)
                ->setDescription($faker->sentence(15, true));
                
                $manager->persist($voiture);
            }
            $manager->flush();
        }
    }
}
