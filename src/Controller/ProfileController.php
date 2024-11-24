<?php

namespace App\Controller;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/myprofile', name: 'profile_page')]
    public function profile(): Response {
        return $this->render(view: 'profile/profile.html.twig');
    }
    
    #[Route('/myprofile/subscriptions', name: 'subscription_page')]
    public function subscribe(EntityManagerInterface $entityManager): Response {
        $repositorySubscription = $entityManager->getRepository(Subscription::class);
        $subscriptions = $repositorySubscription->findAllSubscriptions();
        return $this->render(view: 'profile/subscriptions.html.twig', parameters: ['subscriptions' => $subscriptions]);
    }

    #[Route('/myprofile/settings', name: 'settings_page')]
    public function settings(): Response {
        return $this->render(view: 'profile/settings.html.twig');
    }
}
