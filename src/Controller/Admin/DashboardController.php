<?php

namespace App\Controller\Admin;

use App\Constants\RoleConstant;
use App\Entity\Allergene;
use App\Entity\Categorie;
use App\Entity\Plat;
use App\Entity\Restaurant;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Services\RestaurantService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted(RoleConstant::ROLE_ADMIN)]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private readonly RestaurantService $restaurantService,
    )
    {
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Planeat Admin Panel")
            ->setTitle('
                    <img style="max-width: 15%" src="icons/icon_off.svg">
                    Planeat
                    <span class="text-small">Corp.</span>
                ')
            ->setFaviconPath('icons/icon_off.svg');
    }

    public function configureMenuItems(): iterable
    {
        $items = [];
        if($this->isGranted(RoleConstant::ROLE_ADMIN)){
            $items[] = MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            $items[] = MenuItem::section('Gestion des données');
            $items[] = MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', Utilisateur::class);
            $items[] = MenuItem::section('Gestion des Restaurants');
            $items[] = MenuItem::linkToCrud('Restaurants', 'fa fa-utensils', Restaurant::class);
            $items[] = MenuItem::linkToCrud('Plats', 'fa fa-utensils', Plat::class);
            $items[] = MenuItem::subMenu('Ressources', 'fa  fa-bars')->setSubItems([
                MenuItem::linkToCrud('Catégories', 'fa fa-bars', Categorie::class),
                MenuItem::linkToCrud('Allergènes', 'fa fa-bars', Allergene::class),
            ]);
        }
//        $items = array_merge($items, $this->restaurantService->configureMenuItems());

        return $items;

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user);
    }
}
