<?php

namespace App\Controller\Api;

use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharactersController extends AbstractController
{
    /**
     * @Route("/api/personnages", name="api_personnages")
     */
    public function list(CharactersRepository $charactersRepository): JsonResponse
    {
        $characters = $charactersRepository->findAll();

        return $this->json($characters, Response::HTTP_OK, [], [
            'groups' => 'characters_list'
        ]);
    }
}