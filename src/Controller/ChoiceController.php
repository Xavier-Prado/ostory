<?php

namespace App\Controller;

use App\Entity\Choice;
use App\Entity\Story;
use App\Form\TheChoiceType;
use App\Repository\ChoiceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("back/choice")
 */
class ChoiceController extends AbstractController
{
    /**
    * @Route("/", name="app_choice_index", methods={"GET"})
    */
public function index(ChoiceRepository $choiceRepository, PaginatorInterface $paginator, Request $request): Response
{
    
    // Pagination with bundle
    $query = $choiceRepository->findAllChoicesInformation();

    $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        Story::getLimitedResultPerPage() /*limit per page*/
    );

    return $this->render('choice/index.html.twig', [
        // 'choices' => $query,
        'choices' => $pagination,
    ]);
}

    /**
     * @Route("/new", name="app_choice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ChoiceRepository $choiceRepository): Response
    {
        $choice = new Choice();
        $form = $this->createForm(TheChoiceType::class, $choice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $choiceRepository->add($choice, true);

            return $this->redirectToRoute('app_choice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('choice/new.html.twig', [
            'choice' => $choice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_choice_show", methods={"GET"})
     */
    public function show(ChoiceRepository $choiceRepository, int $id): Response
    {
        $choice = $choiceRepository->findChoiceInformation($id);
        
        return $this->render('choice/show.html.twig', [
            'choice' => $choice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_choice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Choice $choice, ChoiceRepository $choiceRepository): Response
    {
        $form = $this->createForm(TheChoiceType::class, $choice, ['data' => $choice]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $choiceRepository->add($choice, true);

            return $this->redirectToRoute('app_choice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('choice/edit.html.twig', [
            'choice' => $choice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_choice_delete", methods={"POST"})
     */
    public function delete(Request $request, Choice $choice, ChoiceRepository $choiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $choice->getId(), $request->request->get('_token'))) {
            $choiceRepository->remove($choice, true);
        }

        return $this->redirectToRoute('app_choice_index', [], Response::HTTP_SEE_OTHER);
    }
}
