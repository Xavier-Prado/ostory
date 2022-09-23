<?php

namespace App\Controller\Api;

use App\Repository\StoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StoryController extends AbstractController
{
    /**
     * Return list of available stories
     * 
     * @Route("/api/histoire", name="api_histoire")
     */
    public function list(StoryRepository $storyRepository): JsonResponse
    {
        $stories = $storyRepository->findAll();
        $storyList = [];
        foreach($stories as $story) {
            foreach($story->getPages() as $key => $page) {
                if($page->isStart()) {
                    $storyList[$key]['story'] = $story;
                    $storyList[$key]['start_page'] = $page->getId();
                }
            }
        }

        // foreach($storyList as $story) {
        //     dd($story['story']->getTitle());
        // }

        return $this->json([$storyList], Response::HTTP_OK, [], [
            'groups' => 'story_list'
        ]);
    }
}
