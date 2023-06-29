<?php

namespace App\Controller\Admin;

use App\Entity\Memory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MemoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Memory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('ramNumber'),
            IntegerField::new('valueMemory'),
        ];
    }
}
