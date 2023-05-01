<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class VehiculefrontController extends AbstractController
{
    #[Route('/vehiculefront', name: 'app_vehiculefront')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('vehiculefront/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }
    #[Route('/home', name: 'app_home')]
    public function index_Home(CategorieRepository $categorieRepository): Response
    {
        return $this->render('front.html.twig', [
           
        ]);
    }
    #[Route('/Search', name: 'app_vehicule_search', methods: ['GET', 'POST'])]
    public function search(Request $request, CategorieRepository $categorieRepository): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('c')
            ->from(Categorie::class, 'c');
    
        $type = $request->query->get('type');
        $marque = $request->query->get('marque');

       
    
        if (!empty($type)) {
            $queryBuilder->andWhere('c.type LIKE :type')->setParameter('type', '%' . $type . '%');
        }
        if (!empty($marque)) {
            $queryBuilder->andWhere('c.marque LIKE :marque')->setParameter('marque', '%' . $marque . '%');
        }

        $query = $queryBuilder->getQuery();
        $categories = $query->getResult();
    
        return $this->render('vehiculefront/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
