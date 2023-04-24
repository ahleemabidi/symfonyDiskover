<?php

namespace App\Controller;

use App\Entity\Colaborationevent;
use App\Form\ColabType;
use App\Form\ColaborationeventType;
use App\Repository\ColaborationeventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/colaborationevent')]
class ColaborationeventController extends AbstractController
{
    #[Route('/', name: 'app_colaborationevent_index', methods: ['GET'])]
    public function index(Request $request, ColaborationeventRepository $colaborationeventreposotpry, PaginatorInterface $paginator): Response
    {
        $sort = $request->query->get('sort');
        $colaborationevents = $colaborationeventreposotpry->findAllSortedByName($sort);
        
        $colaborationevents = $paginator->paginate(
            $colaborationevents,$request->query->getInt('page',1),limit:6
        );

        return $this->render('colaborationevent/index.html.twig', [
            'colaborationevents' => $colaborationevents,
            'sort' => $sort,
        ]);
    }



    #[Route('/new', name: 'app_colaborationevent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $colaborationevent = new Colaborationevent();
        $form = $this->createForm(ColaborationeventType::class, $colaborationevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($colaborationevent);
            $entityManager->flush();

            return $this->redirectToRoute('app_colaborationevent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colaborationevent/new.html.twig', [
            'colaborationevent' => $colaborationevent,
            'form' => $form,
        ]);
    }


    #[Route('/admin', name: 'display_colab',methods: ['GET', 'POST'])]
    public function indexx(): Response
    {
        $colab =$this->getDoctrine()->getManager()->getRepository(Colaborationevent::class)->findAll();
        return $this->render('colaborationevent/indexx.html.twig', [
            'c'=>$colab
        ]);
    }

    #[Route('/addevent', name: 'app_colaborationevent_addevent', methods: ['GET', 'POST'])]

    public function addevent(Request $request): Response
    {
        $colab = new Colaborationevent();
        $form = $this->createForm(ColabType::class,$colab);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($colab);
            $em->flush();

            return $this->redirectToRoute('display_colab');
        }
        return $this->render('colaborationevent/new.html.twig',['form'=>$form->createView()]);
    }




    #[Route('/{idevent}', name: 'app_colaborationevent_show', methods: ['GET'])]
    public function show(Colaborationevent $colaborationevent): Response
    {
        return $this->render('colaborationevent/show.html.twig', [
            'colaborationevent' => $colaborationevent,
        ]);
    }

    #[Route('/{idevent}/edit', name: 'app_colaborationevent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Colaborationevent $colaborationevent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ColaborationeventType::class, $colaborationevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_colaborationevent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colaborationevent/edit.html.twig', [
            'colaborationevent' => $colaborationevent,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_colaborationevent_delete', methods: ['POST'])]
    public function delete(Request $request, Colaborationevent $colaborationevent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colaborationevent->getIdevent(), $request->request->get('_token'))) {
            $entityManager->remove($colaborationevent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_colaborationevent_index', [], Response::HTTP_SEE_OTHER);
    }















    



    #[Route('/removecolab/{idevent}', name: 'supp_colab')]
    public function suppressionColab(Colaborationevent $colab): Response
    {
        $em= $this->getDoctrine()->getManager();
        $em->remove($colab);
        $em->flush();
        return $this->redirectToRoute('display_colab');
    }




    #[Route('/modifevent/{idevent}', name: 'modifevent')]
    public function modifevent(Request $request , $idevent): Response
    {
        $colab = $this->getDoctrine()->getManager()->getRepository(Colaborationevent::class)->find($idevent);
        $form = $this->createForm(ColabType::class,$colab);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($colab);
            $em->flush();

            return $this->redirectToRoute('display_colab');
        }
        return $this->render('colaborationevent/edit.html.twig',['form'=>$form->createView(),'colaborationevent'=>$colab]);
    }




    #[Route('/showmap/{idevent}', name: 'app_evenement_map', methods: ['GET'])]
    public function map(Colaborationevent $e, EntityManagerInterface $entityManager): Response
    {

        $Colaborationevent = $entityManager
            ->getRepository(Colaborationevent::class)->findBy(
                ['idevent' => $e]
            );
        return $this->render('colaborationevent/api_arcgis.html.twig', [
            'colaborationevents' => $Colaborationevent,
        ]);
    }

}




