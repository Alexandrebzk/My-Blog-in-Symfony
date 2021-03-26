<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
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
                ->setBody($faker->paragraphs(3,true))
                ->setImage("http://placekitten.com/1920/1080")
                ->setCreatedAt(new \DateTime())
                ->setSubtitle('In association with ' . $faker->titleFemale . " " . $faker->firstNameFemale)
                ->setTitle($faker->city);
            for ($j = 0; $j < rand(10,15); $j++){
                $comment = new Comment();
                $comment
                    ->setCreatedAt(new \DateTime())
                    ->setArticle($article)
                    ->setEmail($faker->email)
                    ->setName($faker->firstName . ' ' . $faker->lastName)
                    ->setComment($faker->paragraphs(2,true));
                $manager->persist($comment);
            }
        $manager->persist($article);
        }

        $manager->flush();
    }
}
