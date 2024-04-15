<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }


    public function configureFields(string $pageName): iterable
    {

        if($pageName === Crud::PAGE_INDEX){
                yield TextField::new('nom');
                yield TextField::new('adresse');
                yield TextField::new('code_postal');
                yield BooleanField::new('a_decouvrir');
                yield ImageField::new('logo')
                    ->setBasePath('/uploads/restaurants/images');
        }elseif($pageName === Crud::PAGE_DETAIL){
            yield TextField::new('nom');
            yield ImageField::new('logo')
                ->setBasePath('/uploads/restaurants/images');
            yield TextEditorField::new('description');
            yield TextField::new('adresse');
            yield TextField::new('complement');
            yield TextField::new('code_postal');
            yield TextField::new('siret');
            yield NumberField::new('longitude');
            yield NumberField::new('latitude');
            yield EmailField::new('mail');
            yield TelephoneField::new('telephone');
            yield TextField::new('rib');

        } else{
            yield TextField::new('nom')->setRequired(true);
            yield AssociationField::new('administrateur');
            yield TextField::new('logoFile')
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
                ]);

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
        }
    }

    public function configureActions(Actions $actions): Actions
    {
        $detail = Action::new('detail', 'Voir les détails', 'fa fa-eye')
            ->linkToCrudAction('detail');

        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->setLabel(' Ajouter un restaurant');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->setLabel('Modifier');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Supprimer');
            })
            ->add(Crud::PAGE_INDEX, $detail);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des restaurants')
            ->setPageTitle('new', 'Ajouter un restaurant')
            ->setPageTitle('edit', 'Modifier un restaurant')
            ->setPageTitle('detail', 'Détails du restaurant')
            ->setSearchFields(['nom', 'adresse', 'code_postal', 'siret', 'mail', 'telephone']);
    }
}
