<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Choice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TheChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du choix'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du choix',
                'attr' => [
                    'rows' => 3
                ]
            ])
            ->add('pages', EntityType::class, [
                'class' => Page::class,
                'label' => 'Page liée au choix',
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('page_id', IntegerType::class, [
                'label' => 'Page suivante',
            ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Choice::class,
        ]);
    }
}
