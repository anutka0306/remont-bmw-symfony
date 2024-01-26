<?php

namespace App\Controller\Admin;

use App\Entity\Submodel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SubmodelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Submodel::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ImageField::new('image')->setUploadDir('/public/images/submodels/')->setBasePath('/images/submodels/'),
            AssociationField::new('model_id', 'Model')
        ];
    }

}
