<?php

namespace App\Controller\Admin;

use App\Entity\Smartphone;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SmartphoneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Smartphone::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('serialNumber'),
            BooleanField::new('hasCharger'),
            BooleanField::new('isSold'),
            AssociationField::new('category')
        ];
    }

}
