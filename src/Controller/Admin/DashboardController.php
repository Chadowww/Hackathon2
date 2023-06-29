<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Memory;
use App\Entity\Storage;
use App\Entity\User;
use App\Entity\Year;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Smartphone;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // $url = $adminUrlGenerator->setController(SmartphoneCrudController::class)->generateUrl();
        // return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/home.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Emmaus Connect');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Smartphone', 'fas fa-mobile', Smartphone::class);
        yield MenuItem::linkToCrud('Memory', 'fas fa-memory', Memory::class);
        yield MenuItem::linkToCrud('Storage', 'fas fa-sd-card', Storage::class);
        yield MenuItem::linkToCrud('Age', 'fas fa-heart', Year::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-star', Category::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToRoute('Exit dashboard', 'fas fa-right-from-bracket', 'app_home');
    }
}
