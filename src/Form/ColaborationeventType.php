<?php

namespace App\Form;

use App\Entity\Colaborationevent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColaborationeventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomevent')
            ->add('dateevent')
            ->add('adresseevent')
            ->add('nbrplacevehicule')
            ->add('prixvehiculeevent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colaborationevent::class,
        ]);
    }



    
}
