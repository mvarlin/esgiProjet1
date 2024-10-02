<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OtherController extends AbstractController
{
    #[Route(path: '/subscribe', name: 'other_category')]
    public function subscribe(): Response {
        return $this->render(view: 'other/abonnements.html.twig');
    }

    #[Route(path: '/forgot', name: 'other_forgot')]
    public function forgot(): Response {
        return $this->render(view: 'other/forgot.html.twig');
    }

    #[Route(path: '/upload', name: 'upload')]
    public function upload(): Response {
        return $this->render(view: 'other/upload.html.twig');
    }
}
