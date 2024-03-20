<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if($pageName === Crud::PAGE_INDEX){
                yield ImageField::new('logo')
                    ->setUploadDir('public/uploads/restaurants')
                    ->setBasePath('uploads/restaurants')
                    ->setUploadedFileNamePattern('[name]-[timestamp].[extension]')
                    ->setRequired(true);
                yield TextField::new('nom');
                yield TextField::new('adresse');
                yield TextField::new('code_postal');
                yield BooleanField::new('a_decouvrir');
        }else{
            yield TextField::new('nom')->setRequired(true);
            yield AssociationField::new('administrateur');
            yield ImageField::new('logo')
                ->setUploadDir('public/uploads/restaurants')
                ->setBasePath('uploads/restaurants')
                ->setUploadedFileNamePattern('[name]-[timestamp].[extension]')
                ->setRequired(true);
            yield TextEditorField::new('description');
            yield TextField::new('adresse')->setRequired(true);
            yield TextField::new('complement');
            yield TextField::new('code_postal')->setRequired(true);
            yield TextField::new('siret')->setRequired(true);
            yield NumberField::new('longitude')->setRequired(true);
            yield NumberField::new('latitude')->setRequired(true);
            yield EmailField::new('mail')->setRequired(true);
            yield TelephoneField::new('telephone')->setRequired(true);
            yield TextField::new('rib');
            yield IntegerField::new('nb_table')->setRequired(true);
            yield BooleanField::new('a_decouvrir');
            yield CollectionField::new('plats')->useEntryCrudForm(PlatCrudController::class);

        }

    }

}
