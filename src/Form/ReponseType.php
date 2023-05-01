<?php

namespace App\Form;

use App\Entity\Reponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idclient')
            ->add('idchauffeur')
            ->add('num')
            ->add('resultat')
            ->add('dateR')
            ->add('reclamation', EntityType::class, [
                'class' => 'App\Entity\Reclamation',
                'choice_label' => 'id', // Remplacer "reponse" par le nom de votre propriété ou méthode
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
