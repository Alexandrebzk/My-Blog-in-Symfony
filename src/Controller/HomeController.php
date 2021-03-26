<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ArticleRepository $articleRepository;

    #[Route('/home', name: 'home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findLast(9);
        return $this->render('home/index.html.twig', [
            "articles" => $articles
        ]);
    }
}
