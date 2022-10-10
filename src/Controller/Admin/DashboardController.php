<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Demoblogv2');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'), // génère un lien vers ce dashboard
            MenuItem::section('Blog'), // créer une section pour catégoriser les items du menu
            MenuItem::linkToCrud('Article', 'fas fa-newspaper', Article::class),
            MenuItem::section('Membres'), // créer une section pour catégoriser les items du menu
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
        ];
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
