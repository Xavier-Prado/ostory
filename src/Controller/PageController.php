<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Service\UploadFileService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @Route("/back/page")
 */
class PageController extends AbstractController
{
    /**
     * @Route("/", name="app_page_index", methods={"GET"})
     */
    public function index(PageRepository $pageRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Pagination with bundle
        $query = $pageRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('page/index.html.twig', [
            'pages' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_page_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PageRepository $pageRepository, UploadFileService $uploadFileService): Response
    {
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();

            $newFilename = $uploadFileService->uploadFile($pictureFile, 'page');

            $page->setImage($newFilename);

            $pageRepository->add($page, true);

            return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('page/new.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_page_show", methods={"GET"})
     */
    public function show(Page $page): Response
    {
        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_page_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Page $page, 
        PageRepository $pageRepository, 
        UploadFileService $uploadFileService, 
        Filesystem $filesystem
        ): Response
    {
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);
        $previousPicture = $page->getImage();

        if ($form->isSubmitted() && $form->isValid()) {

            // Get data from uploaded picture
            /** @var UploadFile $pictureFile */
            $pictureFile = $form->get('image')->getData();

            if(!empty($pictureFile)) {
                $newFilename = $uploadFileService->uploadFile($pictureFile, 'page');
               
                // remove the old story image before adding the new
                
                $filesystem->remove($this->getParameter('page_image_directory').'/'.$page->getImage());
                $page->setImage($newFilename);
            } else {
                $page->setImage($previousPicture);
            }
            
            $pageRepository->add($page, true);

            return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('page/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_page_delete", methods={"POST"})
     */
    public function delete(Request $request, Page $page, PageRepository $pageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $page->getId(), $request->request->get('_token'))) {
            $pageRepository->remove($page, true);
        }

        return $this->redirectToRoute('app_page_index', [], Response::HTTP_SEE_OTHER);
    }
}
