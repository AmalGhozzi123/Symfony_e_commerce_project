<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Livres;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivresFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {  $faker=Factory::create('fr_FR');
    
        for($j=1;$j<=3;$j++){
        $cat=new Categories();
        $cat->setLibelle($faker->name())
            ->setDescription($faker->text());
            $manager->persist($cat);
       for($i=1;$i<=50;$i++){
        $livre=new Livres();
        $date=new DateTime('22-08-2002');
        $livre->setLibelle($faker->name())
              ->setResume($faker->text())
              ->setPrix($faker->numberBetween(20,100))
              ->setImage('https://picsum.photos/200/?random='.$i)
              ->setEditeur($faker->company())
              ->setDateEdition($date)
              ->setCategorie($cat);
        $manager->persist($livre);
       }
    }
        $manager->flush();
    }
}
