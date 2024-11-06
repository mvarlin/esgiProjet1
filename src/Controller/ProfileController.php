<?php

namespace App\Controller;

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
    public function subscribe(): Response {
        return $this->render(view: 'profile/subscriptions.html.twig');
    }

    #[Route('/myprofile/settings', name: 'settings_page')]
    public function settings(): Response {
        return $this->render(view: 'profile/settings.html.twig');
    }
}
