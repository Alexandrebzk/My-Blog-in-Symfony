<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encode;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encode = $encoder;
    }
    #[Pure] function fiftyPercent(): bool
    {
        if (rand(0, 1))
            return true;
        return false;
    }

    public
    function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $users = [];
        $articles = [];

        for ($k = 0; $k < rand(10, 20); $k++) {
            $user = new User();
            $bool = $this->fiftyPercent();
            $user
                ->setPseudo($bool ? $faker->titleMale . " " . $faker->firstNameMale : $faker->titleFemale . " " . $faker->firstNameFemale)
                ->setEmail($faker->email)
                ->setPassword($this->encode->encodePassword($user, $user->getPseudo() . $k))
                ->setCreatedAt(new \DateTime())
                ->setImage($bool ? 'img/man.jpg' : 'img/woman.jpg')
                ->setLastConnection(new \DateTime());
            $manager->persist($user);
            for ($i = 0; $i < rand(1, 5); $i++) {
                $article = new Article();
                $article
                    ->setAuthor($user)
                    ->setBody($faker->paragraphs(3, true))
                    ->setImage("http://placekitten.com/1920/1080")
                    ->setCreatedAt(new \DateTime())
                    ->setSubtitle('In association with ' . $faker->titleFemale . " " . $faker->firstNameFemale)
                    ->setTitle($faker->city);
                for ($j = 0; $j < rand(10, 15); $j++) {
                    $comment = new Comment();
                    $comment
                        ->setCreatedAt(new \DateTime())
                        ->setArticle($article)
                        ->setComment($faker->paragraphs(2, true))
                        ->setAuthor($user);
                    $manager->persist($comment);
                }
                $manager->persist($article);
            }
        }

        $manager->flush();
    }
}
