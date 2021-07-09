<?php

namespace App\Controller;

use App\Entity\Guests;
use App\Form\GuestsType;
use App\Repository\GuestsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guests")
 */
class GuestsController extends AbstractController
{
    /**
     * @Route("/", name="guests_index", methods={"GET"})
     */
    public function index(GuestsRepository $guestsRepository): Response
    {
        return $this->render('guests/index.html.twig', [
            'guests' => $guestsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="guests_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $guest = new Guests();
        $form = $this->createForm(GuestsType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guest);
            $entityManager->flush();

            return $this->redirectToRoute('guests_index');
        }

        return $this->render('guests/new.html.twig', [
            'guest' => $guest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guests_show", methods={"GET"})
     */
    public function show(Guests $guest): Response
    {
        return $this->render('guests/show.html.twig', [
            'guest' => $guest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="guests_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Guests $guest): Response
    {
        $form = $this->createForm(GuestsType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guests_index');
        }

        return $this->render('guests/edit.html.twig', [
            'guest' => $guest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guests_delete", methods={"POST"})
     */
    public function delete(Request $request, Guests $guest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($guest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('guests_index');
    }
}
