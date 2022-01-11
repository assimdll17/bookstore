<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('isbn'),
            TextField::new('titre'),
            NumberField::new('nombre_pages'),
            DateField::new('date_de_parution'),
            NumberField::new('note'),
           // CollectionField::new('auteurs'),
            AssociationField::new('auteurs'),
            AssociationField::new('genres'),

            //   CollectionField::new('genres'),
        ];
    }

}
