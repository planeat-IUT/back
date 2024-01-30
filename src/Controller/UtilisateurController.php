<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class UtilisateurController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct
    (

    )
    {}

    public function index(){
    }

    public function login(AuthenticationUtils $authenticationUtils)
    {
        if($this->getUser())
        {
            dd('connecté');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

    }
}
