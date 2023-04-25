<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'Votre email',
            'attr' => [
                'placeholder' => 'Merci de saisir votre email',
                'class' => 'form-control my-2'
            ],
            'label_attr' => [
                'class' => 'text-info'
            ],
            'required' => true,
            'invalid_message' => 'L\'email est obligatoire'
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
            'required' => true,
            'first_options' => [
                'label' => 'Votre mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe',
                    'class' => 'form-control my-2'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmer votre mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre mot de passe',
                    'class' => 'form-control my-2'
                ]
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'S\'inscrire',
            'attr' => [
                'class' => 'btn btn-lg btn-outline-primary mt-4'
            ]
        ])
    ;
}
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
