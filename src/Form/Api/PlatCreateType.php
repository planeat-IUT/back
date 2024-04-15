<?php

namespace App\Form\Api;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class PlatCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', IntegerType::class)
            ->add('categorie_id', IntegerType::class)
            ->add('restaurant_id', IntegerType::class)
            ->add('nom', TextType::class)
            ->add('description', TextType::class)
            ->add('prix', NumberType::class)
            ->add('photo', TextType::class, [
                'required' => false,
            ])
            ->add('clickncollect', CheckboxType::class, [
                'required' => false,
            ])
            ->add('platDuJour', CheckboxType::class, [
                'required' => false,
            ])
            ->add('specialite', CheckboxType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }

}
