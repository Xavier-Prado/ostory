<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use App\Repository\StoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("back/story")
 */
class StoryController extends AbstractController
{
    /**
     * @Route("/", name="app_story_index", methods={"GET"})
     */
    public function index(StoryRepository $storyRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Pagination with bundle
        $query = $storyRepository->findAll();
        $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        10 /*limit per page*/
        );

        return $this->render('story/index.html.twig', [
            'stories' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_story_new", methods={"GET", "POST"})
     */
    public function new(Request $request, StoryRepository $storyRepository, SluggerInterface $slugger): Response
    {
        $story = new Story();
        $form = $this->createForm(StoryType::class, $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $story->setSlug($slugger->slug($story->getTitle())->lower());
            $storyRepository->add($story, true);

            return $this->redirectToRoute('app_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('story/new.html.twig', [
            'story' => $story,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_story_show", methods={"GET"})
     */
    public function show(Story $story): Response
    {
        return $this->render('story/show.html.twig', [
            'story' => $story,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_story_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Story $story, StoryRepository $storyRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(StoryType::class, $story);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $story->setSlug($slugger->slug($story->getTitle())->lower());
            $storyRepository->add($story, true);

            return $this->redirectToRoute('app_story_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('story/edit.html.twig', [
            'story' => $story,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_story_delete", methods={"POST"})
     */
    public function delete(Request $request, Story $story, StoryRepository $storyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$story->getId(), $request->request->get('_token'))) {
            $storyRepository->remove($story, true);
        }

        return $this->redirectToRoute('app_story_index', [], Response::HTTP_SEE_OTHER);
    }


    
}
