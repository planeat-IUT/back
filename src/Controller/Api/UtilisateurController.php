<?php

namespace App\Controller\Api;

use App\Constants\RoleConstant;
use App\Entity\Utilisateur;
use App\Form\Api\UtilisateurCreateType;
use App\Form\Api\UtilisateurUpdateType;
use App\Manager\UtilisateurManager;
use App\Repository\UtilisateurRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Exception;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;



#[Route('api/utilisateurs')]
class UtilisateurController extends AbstractController
{
    public function __construct(
        protected UtilisateurRepository $utilisateurRepository,
        protected UtilisateurManager $utilisateurManager,
        protected FormFactoryInterface $formFactory,
    ){}

    #[Route('/new', name: 'api_utilisateur_new', methods: ['POST'])]
    #[OA\Response(
        response: 201,
        description: 'Create utilisateur and return utilisateur object',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Utilisateur::class, groups: ['utilisateur']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Utilisateur::class,
            )
        )
    )]
    #[OA\Tag(name: 'utilisateurs')]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher,SerializerInterface $serializer): Response|JsonResponse
    {
        try {
            $utilisateur = new Utilisateur();
            $form = $this->formFactory->createNamed(
                '',
                UtilisateurCreateType::class,
                $utilisateur,
                [
                    'csrf_protection' => false,
                    'method'          => 'POST',
                ]
            );
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                if ($this->utilisateurRepository->findOneBy(['email' => $form->get('email')->getData()])) {
                    throw new \RuntimeException('Email already exists');
                }
                $encodedPassword = $userPasswordHasher->hashPassword(
                    $utilisateur,
                    $form->get('password')->getData()
                );
                $utilisateur->setPassword($encodedPassword);
                $utilisateur = $this->utilisateurManager->create($utilisateur, RoleConstant::ROLE_USER);
            } else {
                $errors = [];
                foreach ($form->getErrors(true, true) as $error) {
                    $errors[] = $error->getMessage();
                }
                return new JsonResponse($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $context = (new ObjectNormalizerContextBuilder())
                ->withGroups('utilisateur')
                ->toArray();

            return new JsonResponse(
                $serializer->serialize($utilisateur, 'array', $context),
                Response::HTTP_CREATED,
                ['Content-Type' => 'application/json']
            );
        } catch (Exception|ExceptionInterface $exception) {
            return new JsonResponse([$exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    #[Route('/edit', name: 'api_utilisateur_edit', methods: ['POST'])]
    #[OA\Response(
        response: 200,
        description: 'Edit utilisateur and return utilisateur object',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Utilisateur::class, groups: ['utilisateur']))
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(
                type: Utilisateur::class,
            )
        )
    )]
    #[OA\Tag(name: 'utilisateurs')]
    public function edit(Request $request,SerializerInterface $serializer): Response
    {
        try {
            /** @var Utilisateur $utilisateur */
            if (!($utilisateur = $this->getUser())) {
                throw new AuthenticationException();
            }

            $form = $this->formFactory->createNamed(
                '',
                UtilisateurUpdateType::class,
                $utilisateur,
                [
                    'csrf_protection' => false,
                    'method' => 'POST',
                ]
            );
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $utilisateur = $this->utilisateurManager->edit($utilisateur, RoleConstant::ROLE_USER);

            } else {
                $errors = [];
                foreach ($form->getErrors(true, true) as $error) {
                    $errors[] = $error->getMessage();
                }
                return new JsonResponse($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return new Response(
                $serializer->serialize($utilisateur, 'json', ['groups' => 'utilisateur']),
                Response::HTTP_OK,
                ['Content-Type' => 'application/json']
            );
        } catch (Exception|ExceptionInterface $exception) {
            return new JsonResponse([$exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
