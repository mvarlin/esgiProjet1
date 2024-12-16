<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthController extends AbstractController
{
    // #[Route(path: '/login2', name: 'auth_login')]
    // public function login(): Response {
    //     return $this->render(view: 'auth/login.html.twig');
    // }

    #[Route(path: '/forgot', name: 'auth_forgot')]
    public function forgot(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailerInterface): Response {
        
        // Check si c'est une méthode post
        if($request->isMethod('post')){
            
            //Recup du mail dans le form & Check en base via l'email
            $userMail = $request->get('_email'); 
            $user = $entityManager->getRepository(User::class)->findOneBy(['email'=>$userMail]);

            // Si l'utilisateur existe en base
            if(!is_null($user)){

                // Création de l'uuid & Push en base
                $user->setResetToken(Uuid::v7());
                $entityManager->persist($user);
                $entityManager->flush();

                // Création de mail (Token + destinataire) & Envoi du mail
                $email = (new TemplatedEmail())
                    ->from('matisse.netflex@streemi.com')
                    ->to($userMail)
                    ->subject('Email de')
                    ->htmlTemplate('email/reset.html.twig')
                    ->context([
                        'resetToken' => $user->getResetToken(),
                        'userMail' => $userMail,
                    ]);
                $mailerInterface->send($email);         
            } else {
                // Message Flash dans la view 
                $this->addFlash('error', 'L\'utilisateur n\'existe pas');
            }
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

    #[Route(path: '/reset/{token}', name: 'auth_reset')]
    public function user(UserPasswordHasherInterface $uPHI, EntityManagerInterface $entityManager, string $token, Request $request): Response {
        
        // Check en base via le token
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken'=>$token]); 
        
        // Check si c'est une méthode post & l'utilisateur existe (à modifier ?)
        if ($request->isMethod('POST') && !is_null($user)) { 

            // Les mots de passe sont identiques
            if ($request->get('password') === $request->get('repeat-password')) {

                // Hash le new mdp & Le push en base
                $newPassword = $request->get('password');
                $newPasswordHash = $uPHI->hashPassword($user, $newPassword); 
                $user->setPassword($newPasswordHash); 
                $entityManager->persist($user);
                $entityManager->flush(); 
                
                // Message de validation & Retour vers la page login
                $this->addFlash('success', 'Votre nouveau mot de passe a été modifié correctement');
                return $this->redirectToRoute('app_login');
            } else {
                // dump("mdp différent");
                return $this->render(view: 'auth/reset.html.twig');
            }
        }
        if(!is_null($user)){ // il existe
            return $this->render(view: 'auth/reset.html.twig');
        } else{
            return $this->render(view: 'auth/reset.html.twig');
        }
    }
}
