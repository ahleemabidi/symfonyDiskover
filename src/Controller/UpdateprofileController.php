<?php

namespace App\Controller;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;

use App\Form\UpdateformType;
use Symfony\Component\Routing\Annotation\Route;

class UpdateprofileController extends AbstractController
{
    #[Route('/updateprofile', name: 'app_updateprofile')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $userepo): Response
    {

        
        $user = $entityManager
         ->getRepository(User::class)
         ->findOneBy(['id' => 8]);

         $form = $this->createForm(UpdateformType::class,$user);
         $form->handleRequest($request);

         if ($form->isSubmitted()  && $form->isValid()) {
             
              $entityManager->flush(); 
              $message = 'Le profil est mis a jour avec succés';
              return $this->render('updateprofile/index.html.twig', [
               'controller_name' => 'EditprofileController',
               'UpdateForm' => $form->createView(),
               'user' =>$user,
               
           ]);
         
             
 
     }


        return $this->render('updateprofile/index.html.twig', [
            'controller_name' => 'UpdateprofileController',
            'UpdateForm' => $form->createView(),
               'user' =>$user,
        ]);
    }
}
