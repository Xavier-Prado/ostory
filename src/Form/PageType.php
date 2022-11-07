<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Story;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la page'
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new NotBlank(),
                    new File([],200000,null,[
                        'image/jpeg',
                        'image/gif',
                        'image/bmp',
                        'image/png',
                    ],null, null, 'Image de 200 ko max', 'Format acceptés jpeg/png/bmp/gif uniquement')
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => 6
                ]
            ])
            ->add('start',ChoiceType::class, [
                'label' => 'Page de démarrage de l\'histoire?',
                'choices' => self::START,
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('page_end',ChoiceType::class, [
                'label' => 'Type de page',
                'choices' => [
                    'Victoire' => 1,
                    'Défaite' => 2,
                    'Aller vers une autre page' => 0
                ],
                'multiple' => false,
                'expanded' => true
            ])
            ->add('story', EntityType::class, [
                'class' => Story::class,
                'choice_label' => 'title', 
                'label' => 'Histoire à laquelle ajouter la page'
            ])
        ;
    }

    const START = [
        'Oui' => true,
        'Non' => false
    ];

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
