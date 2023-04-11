<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/base.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/backend', name: 'app_index_backend')]
    public function indexback(): Response
    {
        return $this->render('index/back.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
