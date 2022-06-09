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
            $author = new Author();
            $author->setName("Name_$i");

            $this->addReference("author_$i", $author);

            $manager->persist($author);
        }

        $manager->flush();
    }
}
