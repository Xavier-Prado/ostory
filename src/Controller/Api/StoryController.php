<?php

namespace App\Controller\Api;

use App\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class StoryController extends AbstractController
{
    /**
     * Return list of available stories
     * 
     * @Route("/api/histoire", name="app_api_story")
     */
    public function list(StoryRepository $storyRepository): JsonResponse
    {
        $stories = $storyRepository->findAll();
        foreach($stories as $story) {
            $pages = $story->getPages();
        }

        return $this->json([$stories], Response::HTTP_OK, [], [
            'groups' => 'story_list'
        ]);
    }
}
