<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/category', name: 'movie_category')]
    public function category(): Response {
        return $this->render(view: 'movie/category.html.twig');
    }

    #[Route(path: '/detailserie', name: 'detail_serie')]
    public function detailSerie(): Response {
        return $this->render(view: 'movie/detail_serie.html.twig');
    }

    #[Route(path: '/detail', name: 'detail')]
    public function detail(): Response {
        return $this->render(view: 'movie/detail.html.twig');
    }

    #[Route(path: '/discover', name: 'movie_discover')]
    public function discover(): Response {
        return $this->render(view: 'movie/discover.html.twig');
    }

    #[Route(path: '/lists', name: 'movie_discover')]
    public function list(): Response {
        return $this->render(view: 'movie/lists.html.twig');
    }

    
}
