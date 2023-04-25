<?php

namespace App\Controller;

use App\Entity\Formulairer;
use App\Form\FormulairerType;
use App\Repository\FormulairerRepository;
use Container8Puv8zN\getMercuryseriesFlashy_FlashyNotifierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Knp\Component\Pager\PaginatorInterface;






#[Route('/formulairer')]
class FormulairerController extends AbstractController
{


    #[Route('/', name: 'app_formulairer_index', methods: ['GET'])]
    public function index(Request $request, FormulairerRepository $fr, PaginatorInterface $paginator): Response
    {
        
        
        $sort = $request->query->get('sort');
        $formulairers = $fr->findAllSortedByName($sort);
        
        $formulairers = $paginator->paginate(
            $formulairers,$request->query->getInt('page',1),limit:10
        );

        return $this->render('tables.html.twig', [
            'formulairers' => $formulairers,
            'sort' => $sort,
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

            return $this->render('formulairer/show.html.twig', [
                'formulairer' => $formulairer,
            ]);
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
            return $this->redirectToRoute('app_formulairer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_formulairer_index', [], Response::HTTP_SEE_OTHER);
    }


 

    #[Route('/searchForm', name: 'app_formulairer_searchForm')]
    public function searchForm(Request $request,NormalizerInterface $Normalizer, FormulairerRepository $fr)
    {
        $repository = $this->getDoctrine()->getRepository(Formulairer::class);
        $requestString=$request->get('searchValue');
        $formulaire = $fr->findformulairerbyType($requestString);
        $jsonContent = $Normalizer->normalize($formulaire, 'json',['groups'=>'formulaire']);
        $retour =json_encode($jsonContent);
        return new Response($retour);
    }

   
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts =  $em->getRepository('AppBundle:Post')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getPhoto(),$posts->getTitle()];

        }
        return $realEntities;
    }



   





   //  #[Route('/formulairestat', name: 'app_formulairer_stat', methods: ['GET', 'POST'])]

       /**
     * @Route("/e/formulairestat", name="app_formulairer_stat", methods={"GET"})
     */

    public function Hotel_stat(FormulairerRepository $fRepository): Response
    {
        $nbrs[]=Array();

        $e1=$fRepository->find_Nb_hotel_Par_Etat("haute gamme");
        dump($e1);
        $nbrs[]=$e1[0][1];


        $e2=$fRepository->find_Nb_hotel_Par_Etat("moyenne gamme");
        dump($e2);
        $nbrs[]=$e2[0][1];



        dump($nbrs);
        reset($nbrs);
        dump(reset($nbrs));
        $key = key($nbrs);
        dump($key);
        dump($nbrs[$key]);

        unset($nbrs[$key]);

        $nbrss=array_values($nbrs);
        dump(json_encode($nbrss));

        return $this->render('formulairer/stat.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }














    /**
     * @Route("/r/search_user", name="app_formulairer_search_user", methods={"GET"})
     */

    public function search_usere(Request $request,NormalizerInterface $Normalizer,FormulairerRepository $hrp ): Response
    {

        $requestString=$request->get('searchValue');
        $requestString3=$request->get('orderid');
        $user = $hrp->findUser($requestString,$requestString3);
        $jsoncontentc =$Normalizer->normalize($user,'json',['groups'=>'posts:read']); //jeson format
        $jsonc=json_encode($jsoncontentc);
        if(  $jsonc == "[]" ) { return new Response(null); }
        else{ return new Response($jsonc); }

    }



}  

