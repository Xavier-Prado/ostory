<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/me", name="api_user")
     * 
     * return json data with current user's informations
     * @return JsonResponse
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
     * @Route("/me/edit", name="api_user_edit", methods={"PUT", "PATCH"})
     * 
     */
    public function edit(UserRepository $userRepository, 
                        Request $request, 
                        UserPasswordHasherInterface $passwordHasher, 
                        Security $security,
                        ValidatorInterface $validator
                        )
    {
        // get the content of the request
        $json = $request->getContent();

        $user = $security->getUser();

        if (!$user) {
            return $this->json('Not Found', Response::HTTP_NOT_FOUND);
        }

        $infos = json_decode($json);

        // if the user wants to modify, it won't be empty
        if (!empty($infos->nickname)) {
            $user->setNickname($infos->nickname);
        } else {
            $user->getNickname();
        }

        if (!empty($infos->email)) {
            $user->setEmail($infos->email);
        } else {
            $user->getEmail();
        }

        if (!empty($infos->password)) {
            $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$/";
            if(!preg_match($regex, $infos->password)) {
            return $this->json(["Votre mot de passe doit contenir au moins 8 caractères, dont une lettre, un chiffre et un caractère spécial."], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $password = $passwordHasher->hashPassword($user, $infos->password);
            $user->setPassword($password);
        } else {
            $user->getPassword();
        }


        // validates user entity conformity (validation constraints)
        $errors = $validator->validate($user);

        // error management
        if (count($errors) > 0) {
            $cleanErrors = [];

            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                
                $property = $error->getPropertyPath();
                $message = $error->getMessage();
                $cleanErrors[$property][] = $message;
            }

            // return errors with a HTTP code 422
            return $this->json($cleanErrors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userRepository->add($user, true);

        return $this->json('', Response::HTTP_NO_CONTENT, [], []);
    }

    /**
     * Delete current user
     * 
     * @Route("/me/delete", name="api_user_delete", methods={"DELETE"})
     *
     */
    public function delete(UserRepository $userRepository, Security $security, Request $request)
    {

        // get the content of the request
        $json = $request->getContent();

        $user = $security->getUser();

        if (!$user) {
            return $this->json('Not Found', Response::HTTP_NOT_FOUND);
        }

        $userRepository->remove($user, true);

        return $this->json('', Response::HTTP_NO_CONTENT, [], []);
    }
}