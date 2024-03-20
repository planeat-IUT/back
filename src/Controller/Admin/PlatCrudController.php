<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom')->setRequired(true);

        yield ImageField::new('photo')
            ->setUploadDir('public/uploads/restaurants')
            ->setBasePath('uploads/restaurants')
            ->setUploadedFileNamePattern('[name]-[timestamp].[extension]')
            ->setRequired(true);

        yield TextEditorField::new('description')->setRequired(true);
        yield NumberField::new('prix')->setRequired(true);
        yield AssociationField::new('categorie');
        yield AssociationField::new('allergene');

        yield BooleanField::new('clickncollect');
        yield BooleanField::new('platDuJour');
        yield BooleanField::new('specialite');
    }

}
