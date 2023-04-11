<?php

namespace App\Controller;

use App\Entity\Formulairer;
use App\Form\FormulairerType;
use App\Repository\FormulairerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formulairer')]
class FormulairerController extends AbstractController
{
    #[Route('/', name: 'app_formulairer_index', methods: ['GET'])]
    public function index(FormulairerRepository $formulairerRepository): Response
    {
        return $this->render('tables.html.twig', [
            'formulairers' => $formulairerRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_formulairer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FormulairerRepository $formulairerRepository): Response
    {
        $formulairer = new Formulairer();
        $form = $this->createForm(FormulairerType::class, $formulairer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formulairerRepository->save($formulairer, true);

            return $this->redirectToRoute('app_formulairer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formulairer/new.html.twig', [
            'formulairer' => $formulairer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulairer_show', methods: ['GET'])]
    public function show(Formulairer $formulairer): Response
    {
        return $this->render('formulairer/show.html.twig', [
            'formulairer' => $formulairer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formulairer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formulairer $formulairer, FormulairerRepository $formulairerRepository): Response
    {
        $form = $this->createForm(FormulairerType::class, $formulairer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formulairerRepository->save($formulairer, true);

            return $this->redirectToRoute('app_formulairer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formulairer/edit.html.twig', [
            'formulairer' => $formulairer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formulairer_delete', methods: ['POST'])]
    public function delete(Request $request, Formulairer $formulairer, FormulairerRepository $formulairerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulairer->getId(), $request->request->get('_token'))) {
            $formulairerRepository->remove($formulairer, true);
        }

        return $this->redirectToRoute('app_formulairer_index', [], Response::HTTP_SEE_OTHER);
    }
}
