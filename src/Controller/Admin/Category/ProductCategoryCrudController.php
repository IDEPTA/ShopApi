<?php

namespace App\Controller\Admin\Category;

use App\Entity\ProductCard;
use App\Entity\ProductCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Название'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Категории товаров')
            ->setPageTitle('new', 'Новая категория')
            ->setPageTitle('edit', 'Изменить категорию')
            ->setPageTitle('detail', 'О категории')
            ->setEntityLabelInSingular('категорию')
            ->setEntityLabelInPlural('Катеории')
            ->setPaginatorPageSize(10);
    }
}
