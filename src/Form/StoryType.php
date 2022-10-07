<?php

namespace App\Form;

use App\Entity\Story;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'histoire'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => 6
                ]
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image',
                'help' => 'Url d\'une image'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Story::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
