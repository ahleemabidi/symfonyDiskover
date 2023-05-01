<?php

namespace App\Controller;
use App\Entity\Mission;
use DateTime;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/chauffeur')]
class ChauffeurController extends AbstractController
{
    #[Route('/index', name: 'app_chauffeur_index')]
    public function index(Request $request, MissionRepository $missionRepository): Response
    { // Récupération de la matricule saisie dans le formulaire
        $matricule = $request->query->get('matricule');
    
        // Si la matricule a été saisie, on récupère les missions correspondantes
        if ($matricule) {
            $missions = $missionRepository->findByMatricule($matricule);
        }
        // Sinon, on affiche toutes les missions
        else {
            $missions = $missionRepository->findAll();
        }
    
        return $this->render('chauffeur/afficher.html.twig', [
            'missions' => $missions,
        ]);
    }
    #[Route('/add', name: 'app_mission_add', methods: ['GET', 'POST'])]
    public function add(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createFormBuilder($mission)
            ->add('matricule', TextType::class, [
                'label' => 'Matricule',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();
            $missionRepository->save($mission, true);
    
            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('chauffeur/saisie.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/newMission', name: 'app_chauffeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chauffeur/ajout.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/SearchMission', name: 'app_chauffeur_search', methods: ['GET', 'POST'])]
    public function search(Request $request, MissionRepository $missionRepository): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('m')
            ->from(Mission::class, 'm');
    
        $description = $request->query->get('description');
        
    
        if (!empty($description)) {
            $queryBuilder->andWhere('m.description LIKE :description')->setParameter('description', '%' . $description . '%');
        }
   
    
        $query = $queryBuilder->getQuery();
        $missions = $query->getResult();
    
        return $this->render('chauffeur/afficher.html.twig', [
            'missions' => $missions,
        ]);
    }
}
