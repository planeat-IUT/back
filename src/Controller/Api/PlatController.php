<?php

namespace App\Controller\Api;

use App\Entity\Plat;
use App\Repository\PlatRepository;
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

#[Route('api/plats')]
class PlatController extends AbstractController
{
    public function __construct(
        private readonly PlatRepository $platRepository
    ) {
    }


    #[Route('/', name: 'api_plat_index', methods: ['GET'])]
    #[OA\Response(
        response: 201,
        description: 'show all plats w/o filters',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Plat::class, groups: ['plat']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Plat::class,
            )
        )
    )]
    #[OA\Tag(name: 'plats')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $filters = $request->query->all();

        $plats = $this->platRepository->findByFilters($filters);

        $context = ['groups' => ['plat:read', 'restaurant:read', 'categorie:read', 'allergene:read']];

        return new Response(
            $serializer->serialize($plats, 'json', $context),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'api_plat_show', methods: ['GET'])]
    #[OA\Tag(name: 'plats')]
    public function show(Plat $plat, SerializerInterface $serializer): Response
    {
        return new Response(
            $serializer->serialize($plat, 'json', ['groups' => 'plat:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
