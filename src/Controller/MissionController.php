<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/', name: 'app_mission_index', methods: ['GET'])]
    public function index(Request $request,MissionRepository $missionRepository,PaginatorInterface $paginator): Response
    {
        $sort = $request->query->get('sort');
        $missions = $missionRepository->findAllSortedByheure($sort);
        $missions = $paginator->paginate(
            $missions,$request->query->getInt('page',1),limit:5
        );
        
        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
            'sort' => $sort,

        ]);
    }

    #[Route('/newMission', name: 'app_mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{idMission}', name: 'app_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    #[Route('/{idMission}/edit', name: 'app_mission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);

            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mission/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/{idMission}', name: 'app_mission_delete', methods: ['POST'])]
    public function delete(Request $request, Mission $mission, MissionRepository $missionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mission->getIdMission(), $request->request->get('_token'))) {
            $missionRepository->remove($mission, true);
        }

        return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/searchDescription', name: 'searchDescription', methods: ['GET'])]
    public function searchDesc(Request $request,SerializerInterface $Normalizer,MissionRepository $missionRepository)
    {
        
        $requestString = $request->get('searchValue');
        $mission = $missionRepository->FindMissionByDesc($requestString);
        $jsonContent = $Normalizer->serialize($mission, 'json', ['groups' => 'mission']);
        return new JsonResponse($jsonContent, 200, [], true);
}
}
