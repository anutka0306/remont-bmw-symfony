<?php

namespace App\Controller\Admin;

use App\Admin\Field\CKEditorField;
use App\Entity\Blog;
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

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        $crud->setFormThemes(['@FOSCKEditor/Form/ckeditor_widget.html.twig', '@EasyAdmin/crud/form_theme.html.twig']);
        return $crud;
    }


    public function configureFields(string $blogName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            BooleanField::new('published'),
            TextField::new('name', 'Наименование'),
            ImageField::new('image', 'Превью статьи')->setUploadDir('/public/images/blog-item/')->setBasePath('/images/blog-item'),
            ImageField::new('gallery')
                ->setUploadDir('public/images/blog-list/gallery')
                ->setBasePath('public/images/blog-list/gallery')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setFormTypeOption('multiple', true)->setLabel('Галерея')->hideOnIndex(),
            ImageField::new('content_img')
                ->setUploadDir('public/images/blog-list/content')
                ->setBasePath('public/images/blog-list/content')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setFormTypeOption('multiple', true)->setLabel('Картинки для контента')->hideOnIndex(),
            TextEditorField::new('short_descr', 'Краткое описание'),
            TextField::new('slug', 'Ссылка'),
            TextField::new('meta_title')->hideOnIndex(),
            TextEditorField::new('meta_descr', 'Meta Description')->hideOnIndex(),
            TextEditorField::new('meta_keywords')->hideOnIndex(),
            TextEditorField::new('table_content', 'Оглавление')->hideOnIndex(),
            TextEditorField::new('content', 'Описание')->setFormType(CKEditorType::class),
            AssociationField::new('model', 'Модель'),
            TextField::new('engine', 'Двигатель'),
            TextField::new('car_body', 'Кузов'),
            TextField::new('mileage', 'Пробег'),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
        ];
    }

}
