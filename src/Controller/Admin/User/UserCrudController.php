<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Имя'),
            TextField::new('lastname', 'Фамилия'),
            TextField::new('patronymic', 'Отчество'),
            TextField::new('phone', 'Телефон'),
            EmailField::new('email', 'E-mail'),
            DateField::new('birth_date', 'Дата рождения')
                ->setFormat('dd.MM.yyyy'),
            DateTimeField::new('created_at', 'Дата регистрации')
                ->setFormat('dd.MM.yyyy hh:mm:ss')
                ->hideOnIndex(),
            DateTimeField::new('updated_at', 'Дата обновления')
                ->setFormat('dd.MM.yyyy hh:mm:ss')
                ->hideOnIndex()
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Пользователи')
            ->setPageTitle('new', 'Добавить пользователя')
            ->setPageTitle('edit', 'Редактировать пользователя')
            ->setEntityLabelInSingular('пользователя')
            ->setEntityLabelInPlural('категории');
    }
}
