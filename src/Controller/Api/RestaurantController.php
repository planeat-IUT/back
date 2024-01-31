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

#[Route('api/restaurants')]
class RestaurantController extends AbstractController
{
    public function __construct(
        private readonly RestaurantRepository $restaurantRepository
    ) {
    }


    #[Route('/', name: 'api_restaurant_index', methods: ['GET'])]
    public function index(SerializerInterface $serializer): Response
    {
        $restaurants = $this->restaurantRepository->findAll();
        return new Response(
            $serializer->serialize($restaurants, 'json', ['groups' => 'restaurant:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

}
