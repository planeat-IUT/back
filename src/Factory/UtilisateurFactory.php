<?php

namespace App\Factory;

use App\Constants\RoleConstant;
use App\Entity\Utilisateur;

class UtilisateurFactory {

    /**
     * @param Utilisateur $utilisateur
     * @param string $role
     * @return Utilisateur
     */
    public function create(Utilisateur $utilisateur, string $role): Utilisateur
    {
        //TODO: validate user
        if ($role === RoleConstant::ROLE_ADMIN) {
            $utilisateur->setPassword(md5(rand(0, 1000000).time().rand(0, 1000000)));
        }
        return $this->edit($utilisateur, $role);
    }

    /**
     * @param Utilisateur $utilisateur
     * @param string|null $role
     * @return Utilisateur
     */
    public function edit(Utilisateur $utilisateur, string $role=null): Utilisateur
    {
        if ($role) {
            $utilisateur->setRoles([$role]);
        }
        return $utilisateur;
    }
}
