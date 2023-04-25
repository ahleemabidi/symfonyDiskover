<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Stripe\Charge;
use Stripe\Stripe;


class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }

    #[Route('/stripePayment', name: 'app_stripe', methods: ['GET', 'POST'])]
    public function stripePayment(Request $request): Response
    {
        \Stripe\Stripe::setApiKey($this->getParameter('sk_test_51Mdev4BkXviPD7IqckPNDsrV8KvxnSi8o6VEu8H8VOZBIxTnvVlCn9peUUOAIFo94JTfZHUhuSnh2LPnx1PEOqvj00Bj9fl98o'));
        $token = $request->request->get('stripeToken');
        $charge = Charge::create([
            'amount' => 500,
            'currency' => 'eur',
            'description' => 'Achat de produit(s)',
            'source' => $token,
        ]);
        return $this->render('stripe.html.twig', [
            'charge_id' => $charge->id,
        ]);
    }

   
}
