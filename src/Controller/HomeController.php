<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/home', name: 'home_page')]
    public function home(): Response {
        return $this->render(view: 'index.html.twig');
    }

    #[Route(path: '/defaulthome', name: 'default_home_page')]
    public function default(): Response {
        return $this->render(view: 'index.html.twig');
    }

    #[Route(path: '/basehome', name: 'base_home_page')]
    public function base(): Response {
        return $this->render(view: 'base.html.twig');
    }
}
