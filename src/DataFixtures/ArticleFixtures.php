<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

// https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html#fixture-groups-only-executing-some-fixtures
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Boucle for() pour insérer un certains nombre de données
        for($i = 0; $i < 10; $i++) {

            $number = rand(1, 500);
            $date = new DateTimeImmutable();
            $randDate = $date->modify("+$number day");

            // Instancie l'entité avec laquelle travailler
            $article = new Article();
            $article->setTitle("Titre_$i");
            $article->setDescription("Description_$i");
            $article->setCreatedAt($randDate);
            $article->setAuthor($this->getReference("author_". rand(0, 19)));

            // Met de côté les données en attente d'insertion
            $manager->persist($article);
        }

        // Insère en BDD
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AuthorFixtures::class
        ];
    }
}
