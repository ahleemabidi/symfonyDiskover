<?php

namespace App\Controller;
use App\Repository\CategorieRepository;
use App\Repository\VehiculeRepository;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablesController extends AbstractController
{
    #[Route('/tables', name: 'app_tables')]
    public function index(CategorieRepository $categorieRepository,VehiculeRepository $vehiculeRepository,MissionRepository $missionRepository): Response
    {
        return $this->render('tables/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'vehicules' => $vehiculeRepository->findAll(),
            'missions' => $missionRepository->findAll(),
        ]);
    }
}
