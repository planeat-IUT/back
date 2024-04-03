<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Repository\RestaurantRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class UtilisateurController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct
    (
        private readonly UtilisateurRepository $utilisateurRepository,
        private readonly RestaurantRepository $restaurantRepository
    )
    {}

    #[Route(path: '/test', name: 'test')]
    public function test(){
        $resto = $this->restaurantRepository->findAll();
        $restorant = $resto[0];
        $this->restaurantRepository->remove($restorant);
        $resto = $this->restaurantRepository->findAll();
        dd($resto);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('_profiler_home');
        }

        return $this->render('utilisateur/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('admin');
        }

//        /** @var Utilisateur $uti */
//        $uti = $this->utilisateurRepository->findOneBy(['id'=>1]);
//        $uti->setPassword($userPasswordHasher->hashPassword($uti, 'admin'));
//        $this->utilisateurRepository->save($uti);
//        dd($uti);


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@EasyAdmin/page/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'favicon_path' => 'icons/icon_off.svg',
            'csrf_token_intention' => 'authenticate',
            'page_title' => '<img src="icons/icon_off.svg"><br><p>Planeat Corp.</p> ',
            'username_label' => 'Email',
            'password_label' => 'Mot de passe',
            'sign_in_label' => 'Connexion',
            'target_path' => $this->generateUrl('admin')
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/create-dev-admin', name: 'create_dev_admin')]
    public function createDevAdmin(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $user
            ->setEmail('admin@admin.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($userPasswordHasher->hashPassword($user, 'admin'));
        $entityManager->persist($user);
        $entityManager->flush();
        return new Response('Admin created');
    }

}
