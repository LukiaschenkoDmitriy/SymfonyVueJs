<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VueJsController extends AbstractController
{
    #[Route('/', name: 'app.vuejs')]
    public function index(): Response
    {
        return $this->render('vue_js/index.html.twig');
    }

    #[Route("/", name: 'app.vuejs.post', methods: ["POST"])]
    public function post(Request $request): Response
    {
        $inputBag = $request->request;

        return new JsonResponse(["message" => "Hello"], Response::HTTP_OK);
    }
}
