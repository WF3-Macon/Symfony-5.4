<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Author;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 20; $i++) {
            // Instancie l'entité "Author"
            $author = new Author();
            $author->setName("Name_$i"); // Lui attribue un nom

            // Enregistre l'objet dans une référence avec un nom unique pour l'identifer
            $this->addReference("author_$i", $author);

            // Persiste les données en attente d'insertion en BDD
            $manager->persist($author);
        }

        // Insère toutes les données en BDD avec Doctrine
        $manager->flush();
    }
}
