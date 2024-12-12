<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Language;
use App\Entity\Media;
use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'admin_page')]
    public function adminHome(): Response {
        return $this->render(view: 'admin/admin.html.twig');
    }

    #[Route(path: '/addfilm', name: 'add_film')]
    public function addFilm(EntityManagerInterface $entityManager): Response {
        $repositoryCategory = $entityManager->getRepository(Categorie::class);
        $repositoryLanguage = $entityManager->getRepository(Language::class);
        
        $categorys = $repositoryCategory->findAllCategory();
        $languages = $repositoryLanguage->findAllLanguage();
        
        return $this->render(view: 'admin/admin_add_films.html.twig', parameters: [
            'categorys' => $categorys,
            'languages' => $languages
        ]);
    }

    #[Route(path: '/adminfilms', name: 'admin_film')]
    public function listFilm(EntityManagerInterface $entityManager): Response {
        $repositoryMedia = $entityManager->getRepository(Media::class);
        $medias = $repositoryMedia->findAll();
        return $this->render(view: 'admin/admin_films.html.twig',  parameters: [
            'medias' => $medias,
        ]);
    }

    #[Route(path: '/adminuser', name: 'admin_users')]
    public function user(EntityManagerInterface $entityManager): Response {
        $repositoryCategory = $entityManager->getRepository(User::class);
        $users = $repositoryCategory->findAll();
        return $this->render(view: 'admin/admin_users.html.twig',  parameters: [
            'users' => $users
        ]);
    }

    #[Route(path: '/adminupload', name: 'admin_upload')]
    public function upload(): Response {
        return $this->render(view: 'admin/admin_upload.html.twig');
    }

    
}
