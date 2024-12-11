<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Serie;
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
        return $this->render(view: 'movie/category.html.twig', parameters: [
            'categories' => $categories,
            // 'categoryLists' => $categoryList
        ]);
    }

    #[Route(path: '/detailserie/{id}', name: 'detail_serie')]
    public function detailSerie(Serie $serie): Response {
        return $this->render(view: 'movie/detail_serie.html.twig', parameters: [
            'serie' => $serie
        ]);
    }

    #[Route(path: '/detail/{id}', name: 'detail')]
    public function detail(Media $media): Response {
        return $this->render(view: 'movie/detail.html.twig', parameters: [
            'media' => $media
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
