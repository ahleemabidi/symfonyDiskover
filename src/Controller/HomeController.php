<?php

namespace App\Controller;
use App\Entity\Mission;
use App\Repository\MissionRepository;
use App\Repository\CategorieRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;





class HomeController extends AbstractController
{
    #[Route('/homeAdmin', name: 'app_home_admin')]
    public function index(CategorieRepository $categorieRepository,MissionRepository $missionRepository,VehiculeRepository $vehiculeRepository): Response
    {
        $nbMatricules = $categorieRepository->countDistinctMatricules();
        $nbMissions = $missionRepository->countDistinctMissions();
        $nbVehicules = $vehiculeRepository->findByRes();
        $nbdispo = $vehiculeRepository->findByDispo();
        $nbdesc = $missionRepository->findByDesc();
        $vehicles = $vehiculeRepository->findAll();
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
          // Construire une liste de durées de cours avec les matricules correspondantes
          $coursList = $missionRepository->findAll();

        // Construire une liste de durées de cours avec les matricules correspondantes
        $dureesCoursList = array_reduce($coursList, function ($result, $missions) {
            $duree = $missions->getDuree();
            if ($duree !== null) {
                $matricule = $missions->getMatricule();
                if (!isset($result[$matricule])) {
                    $result[$matricule] = 0;
                }
                $result[$matricule] += $duree;
            }
            return $result;
        }, []);
    $total = array_reduce($nbVehicules, function ($total, $result) {
        return $total + $result['nbVehicules'];
    }, 0);
    foreach ($nbVehicules as &$result) {
        $result['percentage'] = round($result['nbVehicules'] / $total * 100, 2);
    }
    unset($result);
        return $this->render('home/index.html.twig', [
            'nbMatricules' => $nbMatricules,
            'nbMissions' => $nbMissions,
            'dureesCoursList' => $dureesCoursList,
            'nbVehicules'=>$nbVehicules,
             'nbdispo' =>$nbdispo,
             'nbdesc' =>$nbdesc,
             'nbr' => json_encode($nbrss),
             'categories' => $categorieRepository->findAll(),
             'vehicules' => $vehiculeRepository->findAll(),
             'missions' => $missionRepository->findAll(),


         

        ]);
    }
    
}
