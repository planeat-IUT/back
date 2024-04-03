<?php

namespace App\Services;

use App\Controller\Admin\RestaurantCrudController;
use App\Entity\Restaurant;
use App\Entity\Utilisateur;
use App\Repository\RestaurantRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Bundle\SecurityBundle\Security;

class RestaurantService
{

    public function __construct(
        private readonly RestaurantRepository $restaurantRepository,
        private readonly Security $security
    ) {}

    public function configureMenuItems()
    {
        /** @var Utilisateur $user */
        $user = $this->security->getUser();
        $list = $items = [];

        foreach ($user->getAdminRestaurants() as $restaurant) {
            $list[] = MenuItem::subMenu($restaurant->getNom(), 'fa fa-utensils')->setSubItems([
                //todo: add gerant controller
                MenuItem::linkToCrud('Configuration', 'fa fa-cog', Restaurant::class)
                    ->setAction('detail')
                    ->setEntityId($restaurant->getId()),
            ]);
        }
        if (!empty($list)) {
            $items[] = MenuItem::section('Gestion des Restaurants');
            $items = array_merge($items, $list);
        }

        return $items;
    }

}
