<?php

namespace App\Controller;
use App\Entity\Mission;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class EssaiController extends AbstractController
{
    #[Route('/essai', name: 'app_essai')]
    public function index(MissionRepository $missionRepository): Response
    {
        $nbrs[]=Array();
 
        $e1=$missionRepository->findBymission("Inter-Urbain");
        dump($e1);
        $nbrs[]=$e1[0][1];


        $e2=$missionRepository->findBymission("Intra-Urbain");
        dump($e2);
        $nbrs[]=$e2[0][1];



        dump($nbrs);
        reset($nbrs);
        dump(reset($nbrs));
        $key = key($nbrs);
        dump($key);
        dump($nbrs[$key]);

        unset($nbrs[$key]);

        $nbrss=array_values($nbrs);
        dump(json_encode($nbrss));        
        return $this->render('essai/index.html.twig', [
            'nbr' => json_encode($nbrss),

        ]);
    }
    
}
