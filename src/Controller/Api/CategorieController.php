<?php

namespace App\Controller\Api;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\SerializerInterface;
use App\Form\Api\PlatCreateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('api/categories')]
class CategorieController extends AbstractController
{
    public function __construct(
        private readonly CategorieRepository $categorieRepository
    ) {
    }


    #[Route('/', name: 'api_categorie_index', methods: ['GET'])]
    #[OA\Response(
        response: 201,
        description: 'show all categories w/o filters',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Categorie::class, groups: ['categorie']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Categorie::class,
            )
        )
    )]
    #[OA\Tag(name: 'categories')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $filters = $request->query->all();

        $categories = $this->categorieRepository->findAll();

        return new Response(
            $serializer->serialize($categories, 'json', ['groups' => 'categorie:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'api_categorie_show', methods: ['GET'])]
    #[OA\Tag(name: 'categories')]
    public function show(Categorie $categorie, SerializerInterface $serializer): Response
    {
        return new Response(
            $serializer->serialize($categorie, 'json', ['groups' => 'categorie:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
