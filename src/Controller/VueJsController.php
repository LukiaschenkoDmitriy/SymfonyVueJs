<?php

namespace App\Controller;

use App\Service\ClientContactService;
use App\Service\ClientContactValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class VueJsController extends AbstractController
{
    #[Route('/vuejs/{vueJsRouting}', name: 'app.vuejs', methods: ["GET"], requirements: ['vueJsRouting' => '^(?!api).+'], defaults: ['vueJsRouting' => null])]
    public function index(): Response
    {
        return $this->render('vue_js/index.html.twig');
    }

    #[Route("/vuejs", name: 'app.vuejs.post', methods: ["POST"])]
    public function post(Request $request, ClientContactService $clientContactService): Response
    {
        $parameters = json_decode($request->getContent(), true);
        $clientContactValidator = new ClientContactValidator();
        if ($clientContactValidator->validateClientContactData($parameters)) {

            $contact = $clientContactService->createClientContactEntityByInputBag($parameters);

            $serializer = new Serializer([new ObjectNormalizer()], [new XmlEncoder(), new JsonEncoder()]);

            return new JsonResponse($serializer->serialize($contact, "json"), Response::HTTP_OK);
        } else {
            return new JsonResponse(["error" => $clientContactValidator->getErrorList()], Response::HTTP_BAD_REQUEST);
        }
    }
}
