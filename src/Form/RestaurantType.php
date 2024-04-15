<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextType::class, ['required' => false])
            ->add('adresse', TextType::class)
            ->add('complement', TextType::class, ['required' => false])
            ->add('code_postal', TextType::class)
            ->add('siret', TextType::class)
            ->add('longitude', NumberType::class)
            ->add('latitude', NumberType::class)
            ->add('mail', TextType::class)
            ->add('telephone', TextType::class)
            ->add('rib', TextType::class)
            ->add('logo', TextType::class)
            ->add('nb_table', IntegerType::class)
            ->add('a_decouvrir', CheckboxType::class, ['required' => false])
            ->add('clickCollect', CheckboxType::class, ['required' => false])
            ->add('type', TextType::class)
            ->add('prix', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
