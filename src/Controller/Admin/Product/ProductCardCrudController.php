<?php

namespace App\Controller\Admin\Product;

use App\Entity\ProductCard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCardCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCard::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Название'),
            TextField::new('description', 'Описание'),
            MoneyField::new('price', 'Цена,р')->setCurrency('RUB'),
            NumberField::new('quantity', 'Количество,шт'),
            BooleanField::new('availability', 'Доступность'),
            AssociationField::new('category', 'Категория')
                ->formatValue(function ($value) {
                    return $value ? $value->getName() : 'Не указано';
                }),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Продукция')
            ->setPageTitle('new', 'Добавить товар')
            ->setPageTitle('edit', 'Редактировать товар')
            ->setEntityLabelInSingular('продукт')
            ->setEntityLabelInPlural('продукт');
    }
}
