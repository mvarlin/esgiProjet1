<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'login')]
    public function login(): Response {
        return $this->render(view: 'login/login.html.twig');
    }

    #[Route(path: '/confirm', name: 'login_confirm')]
    public function confirm(): Response {
        return $this->render(view: 'login/confirm.html.twig');
    }

    #[Route(path: '/register', name: 'login_register')]
    public function listFilm(): Response {
        return $this->render(view: 'login/register.html.twig');
    }

    #[Route(path: '/reset', name: 'login_reset')]
    public function user(): Response {
        return $this->render(view: 'login/reset.html.twig');
    }

    
}
