<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\UploadFileService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/back/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Pagination with bundle
        $query = $userRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('user/index.html.twig', [
            'users' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request, 
        UserRepository $userRepository, 
        UserPasswordHasherInterface $passwordHasher,
        UploadFileService $uploadFileService
        ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // password hash 
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));

            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();

            if ($pictureFile) {
                $newFilename = $uploadFileService->uploadFile($pictureFile, 'user');
                $user->setProfilePicture($newFilename);
            } else {
                $user->setProfilePicture('profile-picture-base.png');
            }
                
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request, 
        User $user, 
        UserRepository $userRepository, 
        UserPasswordHasherInterface $passwordHasher,
        UploadFileService $uploadFileService,
        Filesystem $filesystem
        ): Response
    {
        $form = $this->createForm(UserType::class, $user);

        // we take password before edit
        $previousPassword = $user->getPassword();
        $previousPicture = $user->getProfilePicture();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $passwordInForm = $form->get('password')->getData();
            // we check if we have submitted password
            if(!empty($passwordInForm)) {
                // if yes (password != null)
                // password hash
                $user->setPassword($passwordHasher->hashPassword($user, $passwordInForm));
            } else {
                // password can't be change, so we put back the previous
                $user->setPassword($previousPassword);
            }

            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();
            
            if(!empty($pictureFile)) {
                $newFilename = $uploadFileService->uploadFile($pictureFile, 'user');

                if (!($user->getProfilePicture() == "profile-picture-base.png")) {
                    // remove the old user image before adding the new
                    $filesystem->remove($this->getParameter('user_image_directory').'/'.$user->getProfilePicture());
                }
                $user->setProfilePicture($newFilename);
            } else {

                $user->setProfilePicture($previousPicture);

            }

            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
