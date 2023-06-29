<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Memory;
use App\Entity\PhoneAge;
use App\Entity\Storage;
use App\Entity\User;
use App\Entity\Smartphone;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/home.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Emmaus Connect');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('style/easyadmin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Mémoire', 'fas fa-memory', Memory::class);
        yield MenuItem::linkToCrud('Stockage', 'fas fa-sd-card', Storage::class);
        yield MenuItem::linkToCrud('Age', 'fas fa-heart', PhoneAge::class);
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-star', Category::class);
        yield MenuItem::linkToCrud('Smartphones', 'fas fa-mobile', Smartphone::class);
        yield MenuItem::linkToCrud('Bénévoles', 'fas fa-user', User::class);
        yield MenuItem::linkToRoute('Quitter', 'fas fa-right-from-bracket', 'app_home');
    }
}
