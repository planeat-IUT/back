<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('restaurant')->setRequired(true);


        yield TextField::new('nom')->setRequired(true);

        yield ImageField::new('photo')
            ->setBasePath('/uploads/plats/images')
            ->onlyOnIndex();

        yield TextField::new('photoFile')
            ->setFormType(VichImageType::class)
            ->setFormTypeOptions([
                'allow_delete' => false,
                'download_uri' => false,
                'download_label' => false,
                'image_uri' => true,
                'required' => $pageName === Crud::PAGE_NEW,
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ]
            ])
            ->hideOnIndex();


        yield TextEditorField::new('description')
            ->hideOnIndex()
            ->setRequired(true);
        yield NumberField::new('prix')->setRequired(true);
        yield AssociationField::new('categorie')->setRequired(true);
        yield AssociationField::new('allergene');
        yield BooleanField::new('clickncollect');
        yield BooleanField::new('platDuJour');
        yield BooleanField::new('specialite');
    }

}
