<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class RestaurantController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    #[Route(
        path: '/api/restaurants',
        name: 'api_restaurants', 
        methods: ['GET']
    )]
    public function index(){
        return new JsonResponse([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RestaurantController.php',
        ]);
    }
}
