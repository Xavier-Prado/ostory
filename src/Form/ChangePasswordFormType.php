<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", "Votre mot de passe ne respecte pas les règles de sécurité.")
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe doivent être identiques !',
                'first_options'  => [
                    'label' => 'Nouveau mot de passe',
                    'help' => 'Au moins 8 caractères, dont une lettre, un chiffre et un caractère spécial.'
                ],
                'second_options' => ['label' => 'Répétez votre mot de passe'],
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
