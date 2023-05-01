<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Dompdf\Options;
use Dompdf\Dompdf;






class ReclamationController extends AbstractController
{ 


 /**
 * @Route("/reclamation/recherche/ajax", name="reclamation_recherche_ajax")
 */
public function rechercheAjax(Request $request)
{
    $entityManager = $this->getDoctrine()->getManager();

    $cin = $request->get('cin');
    $reclamations = $entityManager->getRepository(Reclamation::class)->findBy(['cin' => $cin]);

    if (empty($reclamations)) {
        return new JsonResponse(['message' => 'Aucun enregistrement trouvé.'], 404);
    }

    $data = [];
    foreach ($reclamations as $reclamation) {
        $data[] = [
            'id' => $reclamation->getId(),
            'cin' => $reclamation->getCin(),
            'type' => $reclamation->getType(),
            'objet' => $reclamation->getObjet(),
            'message' => $reclamation->getMessage(),
            'date' => $reclamation->getDate()->format('Y-m-d H:i:s')
        ];
    }

    return new JsonResponse($data);
}


    /**
     * @Route("/reclamation", name="app_reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

     /**
  * @Route("/newReclamation", name="newReclamation")
   
  */

  public function newReclamation(Request $request )
  {   $reclamation= new Reclamation();
      $form =$this->createForm (ReclamationType::class  , $reclamation);
      $form -> add ('Ajouter', SubmitType::Class);
      $form ->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()){
  
    

   
          $reclamation= $form->getData();
          $em= $this->getDoctrine()->getManager();
          $em->persist ($reclamation);
          $em->flush();

// Ajouter le message de notification
$this->addFlash('success', 'Votre réclamation a été envoyée avec succès !');

// Rediriger vers la page d'affichage des réclamations
return $this->redirectToRoute('AfficheReclamation');

 

      }
      return $this->render('reclamation/index.html.twig', [
          'form' => $form -> createView (),
      ]);

       
  }
       /**
     * @Route("/AfficheReclamation", name="AfficheReclamation")
     */
public function AfficheReclamation(){
    $repository = $this->getDoctrine()->getRepository(Reclamation::class); 
    $reclamations = $repository->findAll();
    $inappropriateWords = array('insulte', 'null'); // Remplacez ces mots par les mots réels que vous souhaitez masquer

    foreach ($reclamations as $reclamation) {
        $message = $reclamation->getMessage();
        foreach ($inappropriateWords as $word) {
            $message = str_ireplace($word, str_repeat('*', strlen($word)), $message);
        }
        $reclamation->setMessage($message);
    }

    return $this->render('reclamation/Affiche.html.twig', ['aa' => $reclamations]); 
}

     
        /**
         * @Route ("/deleteReclamation/{id}",name="deleteReclamation")
         */
    public function deleteReclamation($id)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation= $em ->getRepository (Reclamation::class)->find ($id);
        $em->remove($reclamation);
        $em->flush();
         return $this->redirectToRoute('AfficheReclamation') ;
    }
          /**
         * @Route ("/deleteReclamationBack/{id}",name="deleteReclamationBack")
         */
        public function deleteReclamationBack($id)
        {
            $em=$this->getDoctrine()->getManager();
            $reclamation= $em ->getRepository (Reclamation::class)->find ($id);
            $em->remove($reclamation);
            $em->flush();
             return $this->redirectToRoute('AfficheReclamationBack') ;
        }
      /**
     * @Route("/updateReclamation/{id}", name="updateReclamation")
     */
    public function updateReclamation(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $reclamation= $em ->getRepository (Reclamation::class)->find ($id);
        $form =$this->createForm (ReclamationType::class, $reclamation);
        $form -> add ('Update/Modifier', SubmitType::Class);
        $form ->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid ())
        {
            $em->flush();
            return $this->redirectToRoute('AfficheReclamation');
        }
        return $this->render('reclamation/Modifier.html.twig', [
            'form_title'=> "modifier",
            'form' => $form -> createView (),
        ]);
  }

/**
 * Route("/reclamation_recherche_ajax", name="reclamation_recherche_ajax")
 */
public function recherche(Request $request): JsonResponse
{
    $cin = $request->query->get('cin');
    $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->findOneBy(['cin' => $cin]);

    if (!$reclamation) {
        return $this->json([]);
    }

    // extraire les attributs de la réclamation
    $data = [
        'id' => $reclamation->getId(),
        'cin' => $reclamation->getCin(),
        'type' => $reclamation->getType(),
        'objet' => $reclamation->getObjet(),
        'message' => $reclamation->getMessage(),
        'date' => $reclamation->getDate(),
    ];

    return $this->json([$data]);
}
      /**
     * @Route("/AfficheReclamationBack", name="AfficheReclamationBack")
     */
public function AfficheReclamationBack(){
    $entityManager = $this->getDoctrine()->getManager();
    $query = $entityManager->createQuery(
        'SELECT reclamation FROM App\Entity\Reclamation reclamation ORDER BY reclamation.date DESC'
    );
    $reclamation = $query->getResult();

    $inappropriateWords = array('insulte', 'null'); // Remplacez ces mots par les mots réels que vous souhaitez masquer

    foreach ($reclamation as $r) {
        $message = $r->getMessage();

        foreach ($inappropriateWords as $word) {
            $message = str_replace($word, str_repeat('*', strlen($word)), $message);
        }

        $r->setMessage($message);
    }

    return $this->render('reclamation/AfficheBack.html.twig', ['aa' => $reclamation]); 
}
 /**
 * @Route("/pdf", name="PDF_Reclamation", methods={"GET"})
 */
public function pdf(ReclamationRepository $ReclamationRepository)
{
    // Configure Dompdf according to your needs
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');

    // Instantiate Dompdf with our options
    $dompdf = new Dompdf($pdfOptions);
    // Retrieve the HTML generated in our twig file
    $html = $this->renderView('reclamation/pdf.html.twig', [
        'reclamations' => $ReclamationRepository->findAll(),
    ]);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser (inline view)
    $dompdf->stream("liste-reclamations.pdf", [
        "reclamations" => true
    ]);
}

}




 



