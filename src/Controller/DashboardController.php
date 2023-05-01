<?php

namespace App\Controller;
use App\Repository\MissionRepository;
use App\Repository\VehiculeRepository;
use App\Repository\CategorieRepository;

use App\Entity\Mission;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'mission_duration_pie_chart')]
    public function index(MissionRepository $missionRepository,VehiculeRepository $vehiculeRepository,CategorieRepository $categorieRepository): Response
{
    $nbMatricules = $categorieRepository->countDistinctMatricules();
    $nbMissions = $missionRepository->countDistinctMissions();
    $nbVehicules = $vehiculeRepository->findByRes();
    $nbdispo = $vehiculeRepository->findByDispo();
    $nbdesc = $missionRepository->findByDesc();

     

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

    return $this->render('dashboard/index.html.twig', [
        'nbMatricules' => $nbMatricules,
        'nbMissions' => $nbMissions,
        'dureesCoursList' => $dureesCoursList,
        'nbVehicules'=>$nbVehicules,
         'nbdispo' =>$nbdispo,
         'nbdesc' =>$nbdesc,

    ]); }



}
