<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyNumberController extends AbstractController
{
    #[Route('/lucky_number', name: 'luckyNumber')]
    public function index(Request $request): Response
    {
        /**
         *
        $number = random_int(0, 100);

        return new Response(
        "<p>Lucky number: $number</p>"
        );
         */
        $name = $request->query->get('name');
        return $this->json([
            'message' => 'Happy to see you M. or Mrs. ' . $name
        ]);
    }
}
