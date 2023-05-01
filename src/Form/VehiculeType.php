<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('disponibilite')
            ->add('numEntretien')
            ->add('dateEntretien')
            ->add('resEntretien')
            ->add('Ajouter',SubmitType::class , [
                'attr' => ['class' => 'btn btn-primary', 'style' => 'background-color: #BB0B0B; border-color: #BB0B0B;']])
                
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
