<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Transport ;
use Symfony\Component\Mailer\Mailer ;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;



class MaillingController extends AbstractController
{
    #[Route('/mailling', name: 'app_mailling')]
    public function index(): Response
    {
      
           

           $transport = Transport::fromDsn('smtp://jouinimohamed512@gmail.com:iuurgveclizmbjyi@smtp.gmail.com:587');
           $mailer= new Mailer($transport);
         $email= (new TemplatedEmail())
          ->from(new Address('jouinimohamed512@gmail.com', 'DisKover'))
          ->to('ramzihabassi1@gmail.com')
          ->subject('Confirmation De Réservation ')
          ->html("<p>Cher/Chère <strong>[Faten]</strong> ,</p>
          <p>Nous avons le plaisir de vous informer que votre réservation pour notre événement <strong>[Adriatique]</strong> a été acceptée. Nous sommes ravis de vous accueillir à notre événement et nous sommes impatients de vous offrir une expérience mémorable.</p>
          <p>Voici les détails de votre réservation :</p>
          <ul>
            <li>Nom de l'événement : <strong>[Adriatique]</strong></li>
            <li>Date : <strong>[2023-02-15]</strong></li>
            <li>Lieu : <strong>[Kerkouane]</strong></li>
            <li>Nombre de personnes : <strong>[2]</strong></li>
          </ul>
          <p>Veuillez noter que votre réservation est confirmée et que nous vous enverrons un rappel par e-mail quelques jours avant l'événement. Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>
          <p>Nous espérons que vous apprécierez l'événement et que vous passerez un moment agréable avec nous.</p>
          <p>Cordialement,<br>DISKOVER .</p>");
          
          // do anything else you need here, like send an email
          $mailer->send($email);
        
        
    
        return $this->render('mailling/index.html.twig', [
            'controller_name' => 'MaillingController',
        ]);
    }
}
