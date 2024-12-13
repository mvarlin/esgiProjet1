<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    // #[Route(path: '/login2', name: 'auth_login')]
    // public function login(): Response {
    //     return $this->render(view: 'auth/login.html.twig');
    // }

    #[Route(path: '/forgot', name: 'auth_forgot')]
    public function forgot(Request $request, EntityManagerInterface $entityManager): Response {
        $email = $request->get('_email');
        $repositoryUser = $entityManager->getRepository(User::class);
        $result = $repositoryUser->findOneBy(['email'=>$email]);
        dump($result);
        dump($repositoryUser);
        return $this->render(view: 'auth/forgot.html.twig');
    }

    #[Route(path: '/confirm', name: 'auth_confirm')]
    public function confirm(): Response {
        return $this->render(view: 'auth/confirm.html.twig');
    }

    #[Route(path: '/register', name: 'auth_register')]
    public function listFilm(): Response {
        return $this->render(view: 'auth/register.html.twig');
    }

    #[Route(path: '/reset', name: 'auth_reset')]
    public function user(): Response {
        return $this->render(view: 'auth/reset.html.twig');
    }

    
}
