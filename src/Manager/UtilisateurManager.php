<?php

namespace App\Manager;

use App\Constants\RoleConstant;
use App\Entity\Utilisateur;
use App\Factory\UtilisateurFactory;
use App\Repository\UtilisateurRepository;

class UtilisateurManager {

    public function __construct(
        protected UtilisateurRepository $utilisateurRepository,
        protected UtilisateurFactory $utilisateurFactory,
    )
    {}

    /**
     * @param Utilisateur $utilisateur
     * @return Utilisateur
     */
    public function validate(Utilisateur $utilisateur): Utilisateur
    {
        //TODO: validate user
        $this->utilisateurRepository->save($utilisateur, true);
        return $utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     * @param string $role
     * @return Utilisateur
     */
    public function create(Utilisateur $utilisateur, string $role): Utilisateur
    {
        $utilisateur = $this->utilisateurFactory->create($utilisateur, $role);
        $this->utilisateurRepository->save($utilisateur, true);

        //TODO: send email

        return $utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     * @param string|null $role
     * @return Utilisateur
     */
    public function edit(Utilisateur $utilisateur, string $role=null): Utilisateur
    {
        $utilisateur = $this->utilisateurFactory->edit($utilisateur, $role);
        $this->utilisateurRepository->save($utilisateur, true);
        return $utilisateur;
    }
}
