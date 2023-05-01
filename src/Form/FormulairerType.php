<?php

namespace App\Form;

use App\Entity\Formulairer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class FormulairerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('tlp')
            ->add('mail')
            ->add('nbr')
            ->add('type')




            ->add('categ', ChoiceType::class, array(
                'choices' => array(
                    'moyenne gamme' => 'moyenne gamme',
                    'haute gamme' => 'haute gamme',
                   

                )
            ))









            ->add('depart')
            ->add('destination')
            ->add('opt')
            ->add('save',SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formulairer::class,
        ]);
    }
}
