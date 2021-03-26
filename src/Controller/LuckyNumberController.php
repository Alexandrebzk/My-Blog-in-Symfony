<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyNumberController extends AbstractController
{
    /**
     * @Route("/lucky_number", name="app_lucky_number")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $name = $request->query->get('name');
        return $this->json([
            'message' => 'Happy to see you M. or Mrs. ' . $name
        ]);
    }
}
