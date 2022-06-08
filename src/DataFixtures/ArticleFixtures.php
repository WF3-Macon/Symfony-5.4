<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use DateTimeImmutable;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Boucle for() pour insérer un certains nombre de données
        for($i = 0; $i < 10; $i++) {

            // Instancie l'entité avec laquelle travailler
            $article = new Article();
            $article->setTitle("Titre_$i");
            $article->setDescription("Description_$i");
            $article->setCreatedAt(new DateTimeImmutable());

            // Met de côté les données en attente d'insertion
            $manager->persist($article);
        }

        // Insère en BDD
        $manager->flush();
    }
}
