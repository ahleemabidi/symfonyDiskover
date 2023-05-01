<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Form\PromotionType;
use App\Repository\PromotionRepository;
use App\Repository\OffreRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/promotion')]
class PromotionController extends AbstractController
{

    #[Route('/chart', name: 'my_chart')]
    public function myChart(PromotionRepository $promotionRepository): Response
    {


        $entityManager = $this->getDoctrine()->getManager();

// Create a new QueryBuilder instance for the Promotion entity
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('AVG(p.Pourcentage) as avg_discount, COUNT(p.id) as total_promotions, SUM(p.PrixAvant - p.PrixApres) as total_discounts')
            ->from('App\Entity\Promotion', 'p')
            ->where('p.DureeP >= :today')
            ->setParameter('today', new \DateTime());

// Execute the query and fetch the results
        $results = $queryBuilder->getQuery()->getResult();

// Get the average discount percentage, total number of promotions, and total discount amount from the results
        $avgDiscount = $results[0]['avg_discount'];
        $totalPromotions = $results[0]['total_promotions'];
        $totalDiscounts = $results[0]['total_discounts'];

// Render the statistics as a Google Chart
        $chartData = [
            ['Stat', 'Value'],
            ['Average Discount Percentage', $avgDiscount],
            ['Total Promotions', $totalPromotions],
            ['Total Discounts', $totalDiscounts],
        ];
        //$chartData->setElementID('my');

        // dd($pieChart);
        return $this->render('promotion/chart.html.twig', [
            'piechart' => $chartData,

            'promotions' => $promotionRepository->findAll(),
        ]);
    }
    #[Route('/', name: 'app_promotion_index', methods: ['GET'])]
    public function index(PromotionRepository $promotionRepository): Response
    {
        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotionRepository->findAll(),
        ]);
    }

    #[Route('/front', name: 'app_promotion_front', methods: ['GET'])]
    public function indexfront(PromotionRepository $promotionRepository): Response
    {
        return $this->render('promotion/front.html.twig', [
            'promotions' => $promotionRepository->findAll(),
        ]);
    }

// notification
    #[Route('/new/{id}', name: 'app_promotion_new', methods: ['GET', 'POST'])]
    public function new(Request $request,OffreRepository $offreRepository, PromotionRepository $promotionRepository,$id): Response
    {
        $promotion = new Promotion();
        $promotion->setOffre($offreRepository->find($id));
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promotion->setPourcentage(($promotion->getPrixApres()/$promotion->getPrixAvant())*100);
            $promotionRepository->save($promotion, true);

            return $this->redirectToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
        }
      //  $flashy->success('Ajouter Avec Succes');

        return $this->renderForm('promotion/new.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_promotion_show', methods: ['GET'])]
    public function show(Promotion $promotion): Response
    {
        return $this->render('promotion/show.html.twig', [
            'promotion' => $promotion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_promotion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Promotion $promotion, PromotionRepository $promotionRepository): Response
    {
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $promotionRepository->save($promotion, true);

            return $this->redirectToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('promotion/edit.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_promotion_delete', methods: ['POST'])]
    public function delete(Request $request, Promotion $promotion, PromotionRepository $promotionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promotion->getId(), $request->request->get('_token'))) {
            $promotionRepository->remove($promotion, true);
        }

        return $this->redirectToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
    }







}
