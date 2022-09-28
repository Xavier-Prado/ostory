<?php

namespace App\Controller\Api;

use App\Entity\Page;
use App\Entity\Story;
use App\Repository\PageRepository;
use App\Repository\StoryRepository;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class StoryController extends AbstractController
{
    /**
     * Return list of available stories
     * 
     * @Route("/histoire", name="api_histoire")
     * 
     * @return JsonResponse
     */
    public function list(StoryRepository $storyRepository): JsonResponse
    {
        $stories = $storyRepository->findAll();
        

        return $this->json($stories, Response::HTTP_OK, [], [
            'groups' => 'story_list'
        ]);
    }

    /**
     * Return data from required page from the required story
     * 
     * @Route("/histoire/{id}/page/{page_id}", name="api_histoire_page")
     *
     * @return JsonResponse
     */
    public function page(Story $story=null, PageRepository $pageRepository, $page_id) : JsonResponse
    {
        // If story does not exist, return error 404
        if(!$story) {
            return $this->json('story not found', Response::HTTP_NOT_FOUND, [],[]);
        }

        $page = $pageRepository->find($page_id);
        
        // If page does not exist, return error 404
        if(!$page) {
            return $this->json('page not found', Response::HTTP_NOT_FOUND, [],[]);
        }

        $pagesListInStory = $story->getPages();

        $acceptedPages = [];
        // retrieve all the page ids from the selected story
        foreach ($pagesListInStory as $relatedPage) {
            $acceptedPages[] = $relatedPage->getId();
        }

        // Check whether the story pages array contains the page id selected
        if(!in_array($page->getId(), $acceptedPages)) {
            return $this->json('You cannot access this page from here', Response::HTTP_FORBIDDEN, [],[]);
        } 

        return $this->json($page, Response::HTTP_OK, [], [
            'groups' => 'page_content'
        ]);

    }
}
