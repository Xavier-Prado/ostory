<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_main_home", methods={"GET"})
     */
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    
}
