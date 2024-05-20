<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\ContentElements\Teaser;
use App\Entity\Tournament;
use App\Utility\StringUtility;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class PageAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html',FieldDescriptionInterface::TYPE_HTML)
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title')
            ->add('slag')
            ->add('html',TextareaType::class,[
                'attr' => ["class" => "summernote"],
                "required"=>false
            ])
            ->add('tournament', ModelType::class, [
                'label' => 'Aktive Teams',
                'class' => Tournament::class,
                'property' => 'name',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true,
                'btn_add' => false,
            ])
            ->add('contentElementsTeaser',CollectionType::class,
                [
                    "label"=>"Teaser",
                    "btn_catalogue"=>true,
                    "btn_add"=>true,
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => true,
                        'btn_add' => true,
                    ]
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ]
            )
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html')
            ->add('templatename')
            ;
    }

    protected function prePersist(object $object): void
    {
        $object->setSlag(StringUtility::prepareStringForUrl($object->getTitle()));
    }

    protected function preUpdate(object $object): void
    {
        $object->setSlag(StringUtility::prepareStringForUrl($object->getTitle()));
    }
}
