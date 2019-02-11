<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page_index")
     * @Route("/{route}", name="home_page_vue", requirements={"route"="^(?!.*_wdt|_profiler).+"})
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
