<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/api/user")
     */
class UserController extends AbstractController
{
  
    /**
     * @Route("/me", name="api_user")
     */
    public function show(Security $security): JsonResponse
    {
        $user = $security->getUser();


            return $this->json(
                $user,
                200,
                [],
                ["groups" => ["app_user"]]
            );
    }
}
