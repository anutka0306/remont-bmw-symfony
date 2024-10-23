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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
            TextField::new('name', 'Наименование')
            ->setRequired(true)
            ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Название не может быть пустым']),
                ]),
            ImageField::new('image', 'Превью статьи')->setUploadDir('/public/images/blog-item/')->setBasePath('/images/blog-item')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Картинка превью не может быть пустой']),
                ]),
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
            TextEditorField::new('short_descr', 'Краткое описание')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextField::new('slug', 'Ссылка')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextField::new('meta_title')->hideOnIndex()
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextEditorField::new('meta_descr', 'Meta Description')->hideOnIndex()
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextEditorField::new('meta_keywords')->hideOnIndex()
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextEditorField::new('table_content', 'Оглавление')->hideOnIndex()
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextEditorField::new('content', 'Описание')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            AssociationField::new('model', 'Модель')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextField::new('engine', 'Двигатель')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextField::new('car_body', 'Кузов')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            TextField::new('mileage', 'Пробег')
                ->setRequired(true)
                ->setFormTypeOption('constraints', [
                    new NotBlank(['message' => 'Поле не может быть пустым']),
                ]),
            DateTimeField::new('created_at')->hideOnIndex()
                ->setFormTypeOption('data', new \DateTimeImmutable()),
            DateTimeField::new('updated_at')->hideOnIndex()
                ->setFormTypeOption('data', new \DateTimeImmutable()),
        ];
    }

}
