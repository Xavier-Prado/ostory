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
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }
    
    /**
     * @Route("/{id}", name="api_user")
     */
    public function show(User $user, Security $security): JsonResponse
    {

        if ($user->getId()) {
            return $this->json(
                $user,
                200,
                [],
                ["groups" => ["app_user"]]
            );
        } else {
            return $this->json(
                [
                "success" => false
                ],
                Response::HTTP_FORBIDDEN
            );
        }

        // $connectedUser = $this->security->getUser();

        // if ($connectedUser->getId() == $user->getId()) {
        //     return $this->json(
        //         $user,
        //         200,
        //         [],
        //         ["groups" => ["app_user"]]
        //     );
        // } else {
        //     return $this->json(
        //         [
        //         "success" => false
        //         ],
        //         Response::HTTP_FORBIDDEN
        //     );
        // }
    }
}
