<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('adresse')
            ->add('complement')
            ->add('code_postal')
            ->add('siret')
            ->add('longitude')
            ->add('latitude')
            ->add('mail')
            ->add('telephone')
            ->add('rib')
            ->add('logo')
            ->add('nb_table')
            ->add('a_decouvrir')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
