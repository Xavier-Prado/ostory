<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Form\CharactersType;
use App\Repository\CharactersRepository;
use App\Service\UploadFileService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/characters")
 */
class CharactersController extends AbstractController
{
    /**
     * @Route("/", name="app_characters_index", methods={"GET"})
     */
    public function index(CharactersRepository $charactersRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Pagination with bundle
        $query = $charactersRepository->findAll();

        $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        10 /*limit per page*/
        );

        return $this->render('characters/index.html.twig', [
            'characters' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_characters_new", methods={"GET", "POST"})
     */
    public function new(
        Request $request, 
        CharactersRepository $charactersRepository,
        UploadFileService $uploadFileService
        ): Response
    {
        $character = new Characters();
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();
            
            $newFilename = $uploadFileService->uploadFile($pictureFile, 'character');
            
            $character->setImage($newFilename);

            $charactersRepository->add($character, true);

            return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characters/new.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_characters_show", methods={"GET"})
     */
    public function show(Characters $character): Response
    {
        return $this->render('characters/show.html.twig', [
            'character' => $character,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_characters_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request, 
        Characters $character, 
        CharactersRepository $charactersRepository,
        UploadFileService $uploadFileService,
        Filesystem $filesystem
        ): Response
    {

        $previousPicture = $character->getImage();
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();
            // dd($pictureFile);

            if(!empty($pictureFile)) {
                $newFilename = $uploadFileService->uploadFile($pictureFile, 'character');

                $filesystem->remove($this->getParameter('character_image_directory').'/'.$character->getImage());

                $character->setImage($newFilename);
            } else {

                $character->setImage($previousPicture);
            }
            
            $charactersRepository->add($character, true);

            return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('characters/edit.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_characters_delete", methods={"POST"})
     */
    public function delete(
        Request $request, 
        Characters $character, 
        CharactersRepository $charactersRepository,
        Filesystem $filesystem
        ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$character->getId(), $request->request->get('_token'))) {
            $filesystem->remove($this->getParameter('character_image_directory').'/'.$character->getImage());
            $charactersRepository->remove($character, true);
        }


        return $this->redirectToRoute('app_characters_index', [], Response::HTTP_SEE_OTHER);
    }
}
