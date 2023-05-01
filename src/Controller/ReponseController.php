<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ReponseController extends AbstractController
{


    /**
     * @Route("/reponse", name="app_reponse")
     */
    public function index(): Reponse
    {
        return $this->render('reponse/index.html.twig', [
            'controller_name' => 'ReponseController',
        ]);
    }
         /**
  * @Route("/newReponse", name="newReponse")
   
  */

  public function newReponse(Request $request )
  {   $reponse= new Reponse();
      $form =$this->createForm (ReponseType::class  , $reponse);
      $form -> add ('Ajouter', SubmitType::Class);
      $form ->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()){
  
    

   
          $reponse= $form->getData();
          $em= $this->getDoctrine()->getManager();
          $em->persist ($reponse);
          $em->flush();
          return $this->redirectToRoute('AfficheReponse');

      }
      return $this->render('reponse/index.html.twig', [
          'form' => $form -> createView (),
      ]);

       
  }
       /**
     * @Route("/AfficheReponse", name="AfficheReponse")
     */
    public function AfficheReponse(){
        $repository=$this->getDoctrine()->getRepository(Reponse::class); 
        $Reponse=$repository->findAll();
        return $this->render('Reponse/Affiche.html.twig', 
        ['aa'=>$Reponse]); 
     }
           /**
     * @Route("/AfficheReponseFront", name="AfficheReponseFront")
     */
    public function AfficheReponseFront(){
        $repository=$this->getDoctrine()->getRepository(Reponse::class); 
        $Reponse=$repository->findAll();
        return $this->render('Reponse/AfficheFront.html.twig', 
        ['aa'=>$Reponse]); 
     }
     
        /**
         * @Route ("/deleteReponse/{id}",name="deleteReponse")
         */
    public function deleteReponse($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Reponse= $em ->getRepository (Reponse::class)->find ($id);
        $em->remove($Reponse);
        $em->flush();
         return $this->redirectToRoute('AfficheReponse') ;
    }
      /**
     * @Route("/updateReponse/{id}", name="updateReponse")
     */
    public function updateReponse(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $Reponse= $em ->getRepository (Reponse::class)->find ($id);
        $form =$this->createForm (ReponseType::class, $Reponse);
        $form -> add ('Update/Modifier', SubmitType::Class);
        $form ->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid ())
        {
            $em->flush();
            return $this->redirectToRoute('AfficheReponse');
        }
        return $this->render('reponse/Modifier.html.twig', [
            'form_title'=> "modifier",
            'form' => $form -> createView (),
        ]);
  }

}
