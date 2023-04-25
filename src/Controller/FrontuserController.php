<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontuserController extends AbstractController
{
    #[Route('/frontuser', name: 'app_frontuser')]
    public function index(): Response
    {
        return $this->render('frontuser/index.html.twig', [
            'controller_name' => 'FrontuserController',
        ]);
    }
}
