<?php

namespace App\Form;

use App\Entity\Colaborationevent;
use App\Entity\Reservationvehiculee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationvehiculeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomclient')
            ->add('nbrclient')
            ->add('nomevent')
            ->add('idevent',EntityType::class,[
                'class'=>Colaborationevent::class,
                'choice_label'=>'nomEvent'
            ])
            ->add ('Sent_Request',SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationvehiculee::class,
        ]);
    }
}
