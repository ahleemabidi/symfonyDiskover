<?php

namespace App\Controller;

use App\Entity\Facturer;
use App\Form\FacturerType;
use App\Repository\FacturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;

#[Route('/facturer')]
class FacturerController extends AbstractController
{
    #[Route('/', name: 'app_facturer_index', methods: ['GET'])]
    public function index(FacturerRepository $facturerRepository,FlashyNotifier $flashy): Response
    {
        $flashy->success('Liste des factures!', 'http://your-awesome-link.com');

        return $this->render('facturer/index.html.twig', [
            'facturers' => $facturerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_facturer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FacturerRepository $facturerRepository): Response
    {
        $facturer = new Facturer();
        $form = $this->createForm(FacturerType::class, $facturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facturerRepository->save($facturer, true);

            return $this->redirectToRoute('app_facturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facturer/new.html.twig', [
            'facturer' => $facturer,
            'form' => $form,
        ]);
    }

    #[Route('/{id_facture}', name: 'app_facturer_show', methods: ['GET'])]
    public function show(Facturer $facturer): Response
    {
        return $this->render('facturer/show.html.twig', [
            'facturer' => $facturer,
        ]);
    }

    #[Route('/{id_facture}/edit', name: 'app_facturer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Facturer $facturer, FacturerRepository $facturerRepository): Response
    {
        $form = $this->createForm(FacturerType::class, $facturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facturerRepository->save($facturer, true);

            return $this->redirectToRoute('app_facturer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facturer/edit.html.twig', [
            'facturer' => $facturer,
            'form' => $form,
        ]);
    }

    #[Route('/{id_facture}', name: 'app_facturer_delete', methods: ['POST'])]
    public function delete(Request $request, Facturer $facturer, FacturerRepository $facturerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facturer->getId_Facture(), $request->request->get('_token'))) {
            $facturerRepository->remove($facturer, true);
        }

        return $this->redirectToRoute('app_facturer_index', [], Response::HTTP_SEE_OTHER);
    }














    /**
     * @Route("/r/search_user", name="app_facturer_search_user", methods={"GET"})
     */

     public function search_usere(Request $request,NormalizerInterface $Normalizer,FacturerRepository $hrp ): Response
     {
 
         $requestString=$request->get('searchValue');
         $requestString3=$request->get('orderid');
         $user = $hrp->findUser($requestString,$requestString3);
         $jsoncontentc =$Normalizer->normalize($user,'json',['groups'=>'posts:read']); 
         $jsonc=json_encode($jsoncontentc);
         if(  $jsonc == "[]" ) { return new Response(null); }
         else{ return new Response($jsonc); }
 
     }












}
