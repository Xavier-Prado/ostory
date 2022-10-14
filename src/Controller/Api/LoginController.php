<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/api")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
 
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        ManagerRegistry $doctrine
        ) 
    {

        // Retrieve JSON data in the HTTP request coming from the front
        $json = $request->getContent();

        // Deserialisation
        $user = $serializer->deserialize($json, User::class, 'json');

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
        // password hash
        
        if (empty($user->getPassword())) {
            return $this->json(["Vous devez renseigner un mot de passe"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$/";
        
        if(!preg_match($regex, $user->getPassword())) {
            return $this->json(['mot de passe' => "il doit contenir au moins 8 caractères, dont une lettre, un chiffre et un caractère spécial."], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->setPassword($userPasswordHasher->hashPassword($user, $user->getPassword()));
        // Assign a default role
        $user->setRoles(['ROLE_USER']);

        // persist and save the new user in database
        $manager = $doctrine->getManager();
        $manager->persist($user);
        $manager->flush();

        // return HTTP code 201
        return $this->json($user, Response::HTTP_CREATED, [], [
            'groups' => 'users_get_item'
        ]);
    }
}
