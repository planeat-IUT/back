<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantFormType;
use App\Form\RestaurantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RestaurantController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    #[Route('/restaurant/new', name: 'app_new_restaurant')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($restaurant);
            $entityManager->flush();

            return $this->redirectToRoute('app_new_restaurant');
        }

        return $this->render('restaurant/new.html.twig', [
            'restaurantForm' => $form->createView(),
        ]);
    }

    #[Route('/restaurant/{id}/edit', name: 'app_edit_restaurant')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Restaurant $restaurant): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Le formulaire a été soumis et est valide, mettez à jour le restaurant
            $entityManager->flush();

            // Redirigez l'utilisateur vers une page appropriée
            return $this->redirectToRoute('app_edit_restaurant', ['id' => $restaurant->getId()]);
        }

        return $this->render('restaurant/edit.html.twig', [
            'restaurantForm' => $form->createView(),
            'restaurant' => $restaurant,
        ]);
    }
}
