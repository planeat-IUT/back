<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/reservation/new', name: 'app_new_reservation')]
    public function add(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_new_reservation');
        }

        return $this->render('reservation/new.html.twig', [
            'reservationForm' => $form->createView(),
        ]);
    }

    #[Route('/reservation/{id}/edit', name: 'app_edit_reservation')]
    public function edit(Reservation $reservation, Request $request): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_edit_reservation', ['id' => $reservation->getId()]);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'reservationForm' => $form->createView(),
        ]);
    }

    #[Route('/reservation/{id}/delete', name: 'app_delete_reservation')]
    public function delete(Reservation $reservation): Response
    {
        $entityManager = $this->entityManager;
        $entityManager->remove($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_new_reservation');
    }
}
