<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Model;
use App\Entity\Submodel;
use App\Entity\VideoGallery;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Brand;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BrandCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Remont Bmw Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Brands', 'fas fa-list', Brand::class);
        yield MenuItem::linkToCrud('Models', 'fas fa-list', Model::class);
        yield MenuItem::linkToCrud('Submodels', 'fas fa-list', Submodel::class);
        yield MenuItem::linkToCrud('Pages', 'fas fa-list', Content::class);
        yield MenuItem::linkToCrud('Video Gallery', 'fas fa-list', VideoGallery::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
