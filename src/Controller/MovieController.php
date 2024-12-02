<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Movie;
use App\Repository\CategorieRepository;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/category/{id}', name: 'movie_category')]
    public function category(Categorie $categories, string $id): Response {
        dump($categories);
        return $this->render(view: 'movie/category.html.twig', parameters: [
            'categories' => $categories,
            // 'categoryLists' => $categoryList
        ]);
    }

    #[Route(path: '/detailserie', name: 'detail_serie')]
    public function detailSerie(): Response {
        return $this->render(view: 'movie/detail_serie.html.twig');
    }

    #[Route(path: '/detail/{id}', name: 'detail')]
    public function detail(string $id, Movie $movie): Response {
        $staffs = $movie->getStaff();
        $streams = $movie->getStream();
        dump($staffs);
        dump($movie);
        return $this->render(view: 'movie/detail.html.twig', parameters: [
            'movie' => $movie,
            'staffs' => $staffs,
            'streams' => $streams
        ]);
    }

    #[Route(path: '/discover', name: 'movie_discover')]
    public function discover(CategorieRepository $categorieRepository): Response {
        $categorys = $categorieRepository->findAll();
        return $this->render(view: 'movie/discover.html.twig', parameters: ['categorys' => $categorys]);
    }

    #[Route(path: '/lists', name: 'movie_lists')]
    public function list(EntityManagerInterface $entityManager): Response {
        $repositoryMovies = $entityManager->getRepository(Movie::class);
        $movies = $repositoryMovies->findAll();
        return $this->render(view: 'movie/lists.html.twig', parameters: ['movies' => $movies]);
    }

    
}
