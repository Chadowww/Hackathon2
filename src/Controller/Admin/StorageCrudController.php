<?php

namespace App\Controller\Admin;

use App\Entity\Storage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class StorageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Storage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('goStorage'),
            IntegerField::new('valueStorage'),
        ];
    }
}
