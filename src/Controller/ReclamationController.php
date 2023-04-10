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


class ReclamationController extends AbstractController
{
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
        $repository=$this->getDoctrine()->getRepository(Reclamation::class); 
        $reclamation=$repository->findAll();
        return $this->render('reclamation/Affiche.html.twig', 
        ['aa'=>$reclamation]); 
     }
         /**
     * @Route("/AfficheReclamationBack", name="AfficheReclamationBack")
     */
    public function AfficheReclamationBack(){
        $repository=$this->getDoctrine()->getRepository(Reclamation::class); 
        $reclamation=$repository->findAll();
        return $this->render('reclamation/AfficheBack.html.twig', 
        ['aa'=>$reclamation]); 
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

}