<?php

namespace App\Controller\Admin\Product;

use App\Entity\ProductCard;
use App\Entity\ProductCategory;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class ProductDashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCardCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Продукты')
            ->setDefaultColorScheme('dark')
            ->renderSidebarMinimized()
            ->generateRelativeUrls()
            ->setLocales([
                'en' => '🇬🇧 English',
                'ru' => 'ru Russian'
            ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Пользователи', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Продукты', 'fa fa-box', ProductCard::class);
        yield MenuItem::linkToCrud('Категории', 'fa fa-list', ProductCategory::class);
    }
}
