<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/login", name="api_login")
     */
    public function login(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/LoginController.php',
        ]);
    }



    /**
     * @Route("/signin", name="app_register")
     */
    public function signin(Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager, 
        SerializerInterface $serializer, 
        ValidatorInterface $validator, 
        ManagerRegistry $doctrine)
    {

        // récupère le contenu JSON dans la requête HTTP en provenance du front
        $json = $request->getContent();

        //dd($json);

        // désérialisation
        $user = $serializer->deserialize($json, User::class, 'json');

        // dd($user);

        // valide la conformité de notre entité (contraintes de validation)

        $errors = $validator->validate($user);
        // dd($errors);
        // si on a au moins une erreur
        if (count($errors) > 0) {

            // un tableau pour retourner un json propre 
            $cleanErrors = [];        

            /** @var ConstraintViolation $error */
            foreach($errors as $error) {
                // on récupère le champ qui est en erreur
                $property = $error->getPropertyPath();

                // on récupère le message d'erreur
                $message = $error->getMessage();

                // on ajoute le message dans notre tableau à la clé $property
                $cleanErrors[$property][] = $message;

            }

            // on retourne les erreurs avec un status code 422 pour 
            // indiquer qu'on ne peut pas traiter les données
            return $this->json($cleanErrors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // hash du mot de passe 
        $user->setPassword($userPasswordHasher->hashPassword($user, $user->getPassword()));

        // role
        $user->setRoles(['ROLE_USER']);
        // faire persister & sauvegarder l'entité 
        $manager = $doctrine->getManager();
        $manager->persist($user);
        $manager->flush();

        // retourner le JSON de l'utilisateur qu'on vient d'ajouter (avec son ID)
        // avec le code 201 CREATED
        return $this->json($user, Response::HTTP_CREATED, [], [
            'groups' => 'users_get_item'
        ]);
    }
}
