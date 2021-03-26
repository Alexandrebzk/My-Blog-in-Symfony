<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article
                ->setAuthor($faker->titleMale . " " . $faker->firstNameMale)
                ->setBody($faker->paragraph(2))
                ->setImage($faker->imageUrl(286, 180, 'cats'))
                ->setCreatedAt(new \DateTime())
                ->setSubtitle('In association with ' . $faker->titleFemale . " " . $faker->firstNameFemale)
                ->setTitle($faker->city);
        $manager->persist($article);
        }

        $manager->flush();
    }
}
