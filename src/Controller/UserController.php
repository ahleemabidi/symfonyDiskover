<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(Request $request,UserRepository $userRepository,PaginatorInterface $paginator): Response
    {
        $sort = $request->query->get('sort');
        $users = $userRepository->findAllSortedByName($sort);
        
        $users = $paginator->paginate(
            $users,$request->query->getInt('page',1),limit:10
        );

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'sort' => $sort,
        ]);
        
    }
   
     
  

    #[Route('/searchEvenement', name: 'searchEvenement')]
public function searchEvenementx(Request $request, NormalizerInterface $Normalizer, EvenementRepository $sr)
{
    $repository = $this->getDoctrine()->getRepository(Evenement::class);
    $requestString = $request->get('searchValue');
    $Evenements = $repository->findEvenementByNom($requestString);
    $jsonContent = $Normalizer->normalize($Evenements, 'json', ['groups' => 'Evenement']);
    $retour = json_encode($jsonContent);
    return new Response($retour);
}

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
      
    #[Route('/listp', name: 'user_list', methods: ['GET'])]
    public function listp(EntityManagerInterface $entityManager): Response
    {
        $pdfOptions = new Options();
         
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $users = $entityManager
            ->getRepository(User::class)
            ->findAll();
         
        $html = $this->renderView('user/listp.html.twig', [
            'users' => $users,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    
        return new Response(); // Ajoutez cette ligne pour éviter l'erreur
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
