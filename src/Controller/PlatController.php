<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class PlatController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/plat/new', name: 'app_new_plat')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('app_new_plat');
        }

        return $this->render('plat/new.html.twig', [
            'platForm' => $form->createView(),
        ]);
    }

    #[Route('/plat/{id}/edit', name: 'app_edit_plat')]
    public function edit(Plat $plat, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_edit_plat', ['id' => $plat->getId()]);
        }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'platForm' => $form->createView(),
        ]);
    }

    #[Route('/plat/{id}/delete', name: 'app_delete_plat')]
    public function delete(Plat $plat): Response
    {
        $entityManager = $this->entityManager;
        $entityManager->remove($plat);
        $entityManager->flush();

        return $this->redirectToRoute('app_new_plat');
    }

}
