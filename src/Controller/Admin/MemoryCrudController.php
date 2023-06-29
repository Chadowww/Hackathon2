<?php

namespace App\Controller\Admin;

use App\Entity\Memory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            IntegerField::new('ramNumber', 'RAM'),
            IntegerField::new('valueMemory', 'Valeur de mémoire'),
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
            ->setPageTitle('index', 'Tous les critères de mémoire')
            ->setPageTitle('new', 'Ajouter un nouveau critère de mémoire')
            ->setPageTitle('edit', 'Modifier le critère de mémoire')
            ->setPageTitle('detail', 'Détails')
            ;
    }
}
