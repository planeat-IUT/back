<?php

namespace App\Controller\Api;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('api/restaurants')]
class RestaurantController extends AbstractController
{
    public function __construct(
        private readonly RestaurantRepository $restaurantRepository
    ) {
    }


    #[Route('/', name: 'api_restaurant_index', methods: ['GET'])]
    #[OA\Response(
        response: 201,
        description: 'show all restaurants w/o filters',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Restaurant::class, groups: ['restaurant']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Restaurant::class,
            )
        )
    )]
    #[OA\Tag(name: 'restaurants')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $filters = $request->query->all();

        $restaurants = $this->restaurantRepository->findByFilters($filters);

        return new Response(
            $serializer->serialize($restaurants, 'json', ['groups' => 'restaurant:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'api_restaurant_show', methods: ['GET'])]
    #[OA\Tag(name: 'restaurants')]
    public function show(Restaurant $restaurant, SerializerInterface $serializer): Response
    {
        return new Response(
            $serializer->serialize($restaurant, 'json', ['groups' => 'restaurant:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}

