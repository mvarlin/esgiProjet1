<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Categorie;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/category/{id}', name: 'movie_category')]
    public function category(EntityManagerInterface $entityManager, int $id): Response {
        $repositoryCategory = $entityManager->getRepository(Categorie::class);

        $categoryOne = $repositoryCategory->findOneById($id);
        $categorys = $repositoryCategory->findAllCategory();

        return $this->render(view: 'movie/category.html.twig', parameters: ['categorys' => $categorys, 'categoryOne' => $categoryOne]);
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
    public function discover(EntityManagerInterface $entityManager): Response {
        $repositoryCategory = $entityManager->getRepository(Categorie::class);
        $categorys = $repositoryCategory->findAllCategory();
        return $this->render(view: 'movie/discover.html.twig', parameters: ['categorys' => $categorys]);
    }

    #[Route(path: '/lists', name: 'movie_lists')]
    public function list(EntityManagerInterface $entityManager): Response {
        $repositoryMovies = $entityManager->getRepository(Movie::class);
        $movies = $repositoryMovies->findAll();
        return $this->render(view: 'movie/lists.html.twig', parameters: ['movies' => $movies]);
    }

    
}
