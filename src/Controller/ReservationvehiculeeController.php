<?php

namespace App\Controller;

use App\Entity\Reservationvehiculee;
use App\Form\ReservationvehiculeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservationvehiculee')]
class ReservationvehiculeeController extends AbstractController
{
    #[Route('/', name: 'app_reservationvehiculee_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservationvehiculees = $entityManager
            ->getRepository(Reservationvehiculee::class)
            ->findAll();

        return $this->render('reservationvehiculee/index.html.twig', [
            'reservationvehiculees' => $reservationvehiculees,
        ]);
    }

    #[Route('/new', name: 'app_reservationvehiculee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationvehiculee = new Reservationvehiculee();
        $form = $this->createForm(ReservationvehiculeeType::class, $reservationvehiculee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationvehiculee);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationvehiculee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservationvehiculee/new.html.twig', [
            'reservationvehiculee' => $reservationvehiculee,
            'form' => $form,
        ]);
    }

    #[Route('/{idreservationv}', name: 'app_reservationvehiculee_show', methods: ['GET'])]
    public function show(Reservationvehiculee $reservationvehiculee): Response
    {
        return $this->render('reservationvehiculee/show.html.twig', [
            'reservationvehiculee' => $reservationvehiculee,
        ]);
    }



    #[Route('/{idreservationv}/edit', name: 'app_reservationvehiculee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservationvehiculee $reservationvehiculee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationvehiculeeType::class, $reservationvehiculee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationvehiculee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservationvehiculee/edit.html.twig', [
            'reservationvehiculee' => $reservationvehiculee,
            'form' => $form,
        ]);
    }

    #[Route('/{idreservationv}', name: 'app_reservationvehiculee_delete', methods: ['POST'])]
    public function delete(Request $request, Reservationvehiculee $reservationvehiculee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationvehiculee->getIdreservationv(), $request->request->get('_token'))) {
            $entityManager->remove($reservationvehiculee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationvehiculee_index', [], Response::HTTP_SEE_OTHER);
    }








    
}
