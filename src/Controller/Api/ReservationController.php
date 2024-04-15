<?php

namespace App\Controller\Api;

use App\Entity\Reservation;
use App\Form\RestaurantType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('api/reservations')]
class ReservationController extends AbstractController
{
    public function __construct(
        private readonly ReservationRepository $reservationRepository
    ) {
    }


    #[Route('/', name: 'api_reservation_index', methods: ['GET'])]
    #[OA\Response(
        response: 201,
        description: 'show all reservations w/o filters',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Reservation::class, groups: ['reservation']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Reservation::class,
            )
        )
    )]
    #[OA\Tag(name: 'reservations')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $filters = $request->query->all();

        $reservations = $this->reservationRepository->findByFilters($filters);

        return new Response(
            $serializer->serialize($reservations, 'json', ['groups' => 'reservation:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'api_reservation_show', methods: ['GET'])]
    #[OA\Tag(name: 'reservations')]
    public function show(Reservation $reservation, SerializerInterface $serializer): Response
    {
        return new Response(
            $serializer->serialize($reservation, 'json', ['groups' => 'reservation:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}

