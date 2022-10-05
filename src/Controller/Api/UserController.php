<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    /**
     * If authorized modify user's information
     * 
     * @Route("/{id}/edit", name="api_user_edit", methods={"PUT", "PATCH"})
     * 
     */
    public function edit(UserRepository $userRepository, int $id, Request $request, SerializerInterface $serializer, UserPasswordHasherInterface $passwordHasher, Security $security)
    {
        // get the content of the request
        $json = $request->getContent();

        $user = $userRepository->find($id);

        
        $userToModify = $serializer->deserialize($json, User::class, 'json');

        if(!$user) {
            return $this->json('Not Found', Response::HTTP_NOT_FOUND);
        }

        /* $connectedUser = $this->security->getUser(); */
        if(!$user->getId() /* == $connectedUser->getId() */) {
            return $this->json('You cannot delete another user account', Response::HTTP_UNAUTHORIZED);

        }

        // if the user wants to modify, it won't be empty
        if(empty($userToModify->getNickname())) {
            $user->setNickname($user->getNickname());
        } else {
            $user->setNickname($userToModify->getNickname());
        }

        if(empty($userToModify->getEmail())) {
            $user->setEmail($user->getEmail());
        } else {
            $user->setEmail($userToModify->getEmail());
        }

        if(empty($userToModify->getPassword())) {
            $user->setPassword($user->getPassword());
        } else {
            $password = $passwordHasher->hashPassword($user, $userToModify->getPassword());
            $user->setPassword($password);
        }

        $userRepository->add($user, true);

        return $this->json('', Response::HTTP_NO_CONTENT, [], []);
    }

    /**
     * Delete user
     * 
     * @Route("/{id}/delete", name="api_user_delete", methods={"POST"})
     *
     */
    public function delete(UserRepository $userRepository, int $id, Security $security) {

        /* $connectedUser = $this->security->getUser(); */

        $user = $userRepository->find($id);

        if(!$user) {
            return $this->json('Not Found', Response::HTTP_NOT_FOUND);
        }

        if(!$user->getId() /* == $connectedUser->getId() */) {
            return $this->json('You cannot delete another user account', Response::HTTP_UNAUTHORIZED);
        }

        $userRepository->remove($user, true);

        
        return $this->json('', Response::HTTP_NO_CONTENT, [], []);

    }
}
