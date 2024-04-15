<?php

namespace App\Controller\Api;

use App\Entity\Allergene;
use App\Repository\AllergeneRepository;
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

#[Route('api/allergenes')]
class AllergeneController extends AbstractController
{
    public function __construct(
        private readonly AllergeneRepository $allergeneRepository
    ) {
    }


    #[Route('/', name: 'api_allergene_index', methods: ['GET'])]
    #[OA\Response(
        response: 201,
        description: 'show all allergenes w/o filters',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Allergene::class, groups: ['allergene']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Allergene::class,
            )
        )
    )]
    #[OA\Tag(name: 'allergenes')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $filters = $request->query->all();

        $allergenes = $this->allergeneRepository->findAll();

        return new Response(
            $serializer->serialize($allergenes, 'json', ['groups' => 'allergene:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/{id}', name: 'api_allergene_show', methods: ['GET'])]
    #[OA\Tag(name: 'allergenes')]
    public function show(Allergene $allergene, SerializerInterface $serializer): Response
    {
        return new Response(
            $serializer->serialize($allergene, 'json', ['groups' => 'allergene:read']),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
