<?php

namespace App\Controller\Admin;

use App\Entity\PhoneAge;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PhoneAgeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhoneAge::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnIndex()
                ->hideOnForm(),
            IntegerField::new('phoneAge', 'Ancienneté'),
            IntegerField::new('valueYear', 'Valeur d\'ancienneté'),
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
            ->setPageTitle('index', 'Tous les critères d\'ancienneté')
            ->setPageTitle('new', 'Ajouter un nouveau critère d\'ancienneté')
            ->setPageTitle('edit', 'Modifier le critère d\'ancienneté')
            ->setPageTitle('detail', 'Détails')
            ;
    }
}
