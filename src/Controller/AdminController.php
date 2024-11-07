<?php

namespace App\Controller;
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
    public function addFilm(): Response {
        return $this->render(view: 'admin/admin_add_films.html.twig');
    }

    #[Route(path: '/adminfilms', name: 'admin_film')]
    public function listFilm(): Response {
        return $this->render(view: 'admin/admin_films.html.twig');
    }

    #[Route(path: '/adminuser', name: 'admin_users')]
    public function user(): Response {
        return $this->render(view: 'admin/admin_users.html.twig');
    }

    #[Route(path: '/adminupload', name: 'admin_upload')]
    public function upload(): Response {
        return $this->render(view: 'admin/admin_upload.html.twig');
    }

    
}
