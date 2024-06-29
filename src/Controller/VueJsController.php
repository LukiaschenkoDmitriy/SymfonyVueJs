<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VueJsController extends AbstractController
{
    #[Route('/{vuejsRouting}', name: 'app.vuejs', requirements: ['vuejsRouting' => '^(?!api).+'], defaults: ['vuejsRouting' => null])]
    public function index(): Response
    {
        return $this->render('vue_js/index.html.twig');
    }
}
