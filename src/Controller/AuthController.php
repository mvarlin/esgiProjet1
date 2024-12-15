<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\From;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mailer\MailerInterface;

class AuthController extends AbstractController
{
    // #[Route(path: '/login2', name: 'auth_login')]
    // public function login(): Response {
    //     return $this->render(view: 'auth/login.html.twig');
    // }

    #[Route(path: '/forgot', name: 'auth_forgot')]
    public function forgot(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailerInterface): Response {
        $userMail = $request->get('_email');
        $repositoryUser = $entityManager->getRepository(User::class);
        $result = $repositoryUser->findOneBy(['email'=>$userMail]); //Check en base via l'email
        
        if(!is_null($result)){ // il existe
            $uuid = Uuid::v7();
            dump($uuid);
            $result->setResetToken($uuid); //modifier le champs uuid pour ajouter le token
            dump($result);
            $entityManager->persist($result);
            $entityManager->flush(); //push

            $email = (new TemplatedEmail())
                ->from('fabien@example.com')
                ->to($userMail)
                ->subject('Email de')
                ->htmlTemplate('email/reset.html.twig')
                ->context([
                    'resetToken' => $uuid,
                    'userMail' => $userMail,
                ]);
            $mailerInterface->send($email);
        } else { // existe pas
            $this->addFlash('success', 'Utilisateur existe pas');
            dump("exist pas");
        }
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
