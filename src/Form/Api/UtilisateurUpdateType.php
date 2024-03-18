<?php

namespace App\Form\Api;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UtilisateurUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'constraints' => [
                    new Email([
                        'message' => 'L\'adresse email n\'est pas valide',
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez saisir un nom'
                    ])
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez saisir un prénom'
                    ])
                ]
            ])
            ->add('civilite', TextType::class, ['required' => false])
            ->add('telephone', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => "/^[0-9]*$/",
                        'message' => 'Le numéro de téléphone n\'est pas valide',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, ['required' => false])
            ->add('codePostal', TextType::class, ['required' => false])
            ->add('ville', TextType::class, ['required' => false])
            ->add('newsletter', CheckboxType::class, ['required' => false, 'mapped' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
