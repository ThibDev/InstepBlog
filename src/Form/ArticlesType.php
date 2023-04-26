<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Themes;
use App\Repository\ThemesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'article',
                'attr' => [
                    'placeholder' => 'saisir le titre de l\'article',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de l\'article',
                'attr' => [
                    'placeholder' => 'Saisir le contenu de l\'article',
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('illustration', TextType::class, [
                'label' => 'Image de l\'article',
                'attr' => [
                    'placeholder' => 'Merci de saisir l\'url de l\'image de l\'article',
                    'class' => 'form-control my-2'
                ],
                'label_attr' => [
                    'class' => 'text-info'
                ]
            ])
            ->add('theme', EntityType::class, [
                'label' => 'Choix du thème',
                'label_attr' => [
                    'class' => 'text-info'
                ],
                'required' => true,
                'class' => Themes::class,
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'mx-3 form-check'
                ],
                'choice_attr' => [
                    'class' => 'my-2'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-lg btn-outline-success mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
