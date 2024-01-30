<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Content;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud->setFormThemes(['@FOSCKEditor/Form/ckeditor_widget.html.twig', '@EasyAdmin/crud/form_theme.html.twig']);
        return $crud;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            AssociationField::new('parent_id'),
            TextField::new('page_type'),
            TextField::new('path'),
            TextField::new('h1')->hideOnIndex(),
            TextField::new('meta_title')->hideOnIndex(),
            TextEditorField::new('meta_description')->hideOnIndex(),
            TextEditorField::new('text', 'Text')->setFormType(CKEditorType::class),
            BooleanField::new('published'),
            NumberField::new('sort'),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
            AssociationField::new('brand'),
            AssociationField::new('model'),
            AssociationField::new('submodel'),
            BooleanField::new('in_header_nav'),
            BooleanField::new('in_footer_nav'),
            TextField::new('menu_name'),
            ImageField::new('image')->setUploadDir('/public/images/submodels_services/')->setBasePath('/images/submodels_services'),
            TextField::new('short_name'),
        ];
    }

}
