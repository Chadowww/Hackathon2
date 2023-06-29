<?php

namespace App\Controller\Admin;

use App\Entity\Storage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
            IdField::new('id')
                ->hideOnIndex()
                ->hideOnForm(),
            IntegerField::new('goStorage', 'Stockage (en GO)'),
            IntegerField::new('valueStorage', 'Valeur de stockage'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Tous les critères de stockage')
            ->setPageTitle('new', 'Ajouter un nouveau critère de stockage')
            ->setPageTitle('edit', 'Modifier le critère de stockage')
            ->setPageTitle('detail', 'Détails')
            ;
    }
}
