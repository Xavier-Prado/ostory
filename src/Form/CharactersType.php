<?php

namespace App\Form;

use App\Entity\Characters;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CharactersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du personnage',
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $character = $event->getData();
                $form = $event->getForm();

                if (is_null($character->getImage())) {
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
                            ], null, null, 'Image de 200ko', 'Format acceptés jpeg/png/bmp/gif uniquement')
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
                            ], null, null, 'Image de 200ko', 'Format acceptés jpeg/png/bmp/gif uniquement')
                        ],
                        ]);
                }
            });
    }
                    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        'data_class' => Characters::class,
        'attr' => [
            'novalidate' => 'novalidate'
        ]
    ]);
    }
}
