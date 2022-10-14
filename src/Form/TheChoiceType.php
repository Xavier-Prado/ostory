<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Choice;
use App\Repository\ChoiceRepository;
use App\Repository\PageRepository;
use ArrayObject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TheChoiceType extends AbstractType
{
    private $pageRepository;
    private $choiceRepository;
    private $choice;

    public function __construct(PageRepository $pageRepository, ChoiceRepository $choiceRepository)
    {
        $this->choiceRepository = $choiceRepository;
        $this->pageRepository = $pageRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if (!is_null($options['data']->getId())) {
            $storyId = $this->choiceRepository->findStoryId($options['data']);
            $pageList = $this->findAllPages($storyId['id']);
        } else {
            $pageList = $this->findAllPagesNew();
        }

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
                'label' => 'Titre de la page qui mène à ce choix',
                'choice_label' => 'title',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('page_to_redirect', ChoiceType::class, [
                'label' => 'Titre de la page de redirection',
                'choices' => $pageList,
                'multiple' => false,
                'expanded' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Choice::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }

    public function findAllPages(string $id)
    {

        $pageList = $this->pageRepository->findBy(["story" => $id]);
        $pageListToReturn = [];
        foreach ($pageList as $page) {

            $pageListToReturn[$page->getTitle()] = $page->getId();
        }

        return $pageListToReturn;
    }

    public function findAllPagesNew()
    {

        $pageList = $this->pageRepository->findAll();
        $pageListToReturn = [];
        foreach ($pageList as $page) {

            $pageListToReturn[$page->getTitle()] = $page->getId();
        }

        return $pageListToReturn;
    }
}
