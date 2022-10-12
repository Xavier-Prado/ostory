<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôle de l\'utilisateur',
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Modérateur' => 'ROLE_MANAGER',
                    'Administrateur' => 'ROLE_ADMIN'
                ],
                'multiple' => false,
                'expanded' => true
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo'
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // we recover user
                $user = $event->getData();
                // and the form
                $form = $event->getForm();

                // we are in edit or add ?
                if (is_null($user->getId())) {
                    // ID null -> add user
                    // add the field password config for add
                    $form->add('password', RepeatedType::class, [
                        'constraints' => [
                            new NotBlank(),
                            new Regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", "Votre mot de passe ne respecte pas les règles de sécurité.")
                        ],
                        'type' => PasswordType::class,
                        'invalid_message' => 'Les deux mots de passe doivent être identiques !',
                        'first_options'  => [
                            'label' => 'Mot de passe',
                            'help' => 'Au moins 8 caractères, dont une lettre, un chiffre et un caractère spécial.'
                        ],
                        'second_options' => ['label' => 'Répétez votre mot de passe'],
                    ]);
                } else {
                    // ID not null -> edit user existing
                    // we had field password config for edit
                    $form->add('password', RepeatedType::class, [
                        'constraints' => new Regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&-])[A-Za-z\d@$!%*#?&-]{8,}$/", "Votre mot de passe ne respecte pas les règles de sécurité."),
                        'type' => PasswordType::class,
                        'invalid_message' => 'Les deux mots de passe doivent être identiques !',
                        'first_options'  => [
                            'label' => 'Mot de passe',
                            'help' => 'Laissez vide si inchangé.'
                        ],
                        'second_options' => ['label' => 'Répétez votre mot de passe'],
                    ]);
                }
            });

        // datatransformer to convert string<->array
        // @link https://symfony.com/doc/current/form/data_transformers.html
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsArray) {
                    // transform the array to a string
                    return implode(', ', $tagsAsArray);
                },
                function ($tagsAsString) {
                    // transform the string back to an array
                    return explode(', ', $tagsAsString);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
