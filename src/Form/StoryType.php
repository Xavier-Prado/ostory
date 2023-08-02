<?php

namespace App\Form;

use App\Entity\Story;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'histoire',
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => 6
                ]
            ])
        ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            // we recover story
            $story = $event->getData();
            // and the form
            $form = $event->getForm();  

            if (is_null($story->getId())) {
                $form->add('image', FileType::class, [
                    'label' => 'Image',
                    'required' => true,
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Merci d\'enregistrer une image'
                        ]),
                        new File([], 200000, null, [
                            'image/jpeg',
                            'image/gif',
                            'image/bmp',
                            'image/png',
                        ], null, null, 'Image de 200 ko max', 'Format acceptés jpeg/png/bmp/gif uniquement')
                    ],
                ]);
            } else {
                $form->add('image', FileType::class, [
                    'label' => 'Image',
                    'required' => true,
                    'mapped' => false,
                    'constraints' => [
                        new File([], 200000, null, [
                            'image/jpeg',
                            'image/gif',
                            'image/bmp',
                            'image/png',
                        ], null, null, 'Image de 200 ko max', 'Format acceptés jpeg/png/bmp/gif uniquement')
                    ],
                ]);
            }
        });
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
