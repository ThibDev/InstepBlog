<?php

namespace App\Form;

use App\Entity\Themes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ThemesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du thème',
                'attr' => [
                    'placeholder' => 'Merci de saisir le nom du thème',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du thème',
                'attr' => [
                    'placeholder' => 'Merci de saisir la description du thème',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('illustration', FileType::class, [
                'label' => 'Image du thème',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'Merci de saisir l\'url de l\'image du thème',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'constraints' => [
                    new Image([
                        'maxSize' => '2048k',
                        'mimeTypes' => ["image/png", "image/jpeg", "image/pjpeg"],
                        'mimeTypesMessage' => "Formats d'image supportées : .jpg, .png, .jpeg, .pjpeg",
                        'maxSizeMessage' => "La taille autorisée est de 2048k"
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-lg btn-outline-primary mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Themes::class,
        ]);
    }
}