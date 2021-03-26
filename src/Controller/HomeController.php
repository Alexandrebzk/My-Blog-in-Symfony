<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ArticleRepository $articleRepository;

    #[Route('/home', name: 'home')]
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $articleRepository->findAll(),
            $request->query->getInt('page', 1),
            9,[
                'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination)
                'style' => 'bottom',
                'rounded' => true
            ]
        );
        return $this->render('home/index.html.twig', [
            "articles" => $articles
        ]);
    }
}
