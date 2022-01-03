<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr-FR');

        $user = new User();
        $user->setNom($faker->firstName);
        $user->setPrenom($faker->lastName);
        $user->setRole("ROLE_ADMIN");
        $user->setEmail("toto@mail.com");
        $user->setPassword("symfo5");
        $manager->persist($user);

        $tabG  = array();
        for($i=0;$i<10;$i++){
            $genre = new Genre();
            //$nom = $faker->randomElement($array = array ('Policier','Science Fiction','Aventure','Comedy','Horreur','Epouvante','Guerre','Histoire','Biopic','Sante','Cuisine','Sport','Auto-Biographie'));
            $nom=$faker->word;
            $genre->setNom($nom);
            $tabG[$i]=$genre;
            $manager->persist($genre);
        }

        $tabA = array();
       for($i=0;$i<20;$i++){
           $auteur = new Auteur();

           $nom = $faker->name;
           $datenaiss = $faker->dateTimeBetween('-80years','now');
           $national = $faker->country;

           $auteur->setNomPrenom($nom);
           $auteur->setSexe($faker->randomElement($array = array ('M','F')));
           $auteur->setDateDeNaissance($datenaiss);
           $auteur->setNationalite($national);
           $tabA[$i]=$auteur;
           $manager->persist($auteur);
       }
       // $faker->addProvider(new \Faker\Provider\Book($faker));
       for($i=0;$i<50;$i++){


           $livre = new Livre();
           $livre->setIsbn($faker->isbn10) ;
           $titre = $faker->word; $titre2=$faker->word; $titre3=$faker->word;
           $livre->setTitre($titre." ".$titre2." ".$titre3);
           $livre->setNombrePages(mt_rand(160,550));
           $livre->setDateDeParution($faker->dateTime);
           $livre->setNote(mt_rand(0,20));

           $tailleA = random_int(1,3);
           $tailleG = random_int(1,3);

           for($j=0;$j<$tailleA;$j++){
            $livre->addAuteur($tabA[random_int(0,19)]);
        }

        for($j=0;$j<$tailleG;$j++){
            $livre->addGenre($tabG[random_int(0,9)]);
        }

           $manager->persist($livre);

       }

        $manager->flush();
    }
}
