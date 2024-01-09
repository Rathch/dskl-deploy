<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\League;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\AdminType;

final class RelegationAdmin extends AbstractAdmin
{

    public function __construct()
    {
        //$this->generateEncounter();
        parent::__construct();
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
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
            ->add('league',ModelType::class,["label"=>"league","class"=>League::class,"property"=>"seasonName", 'expanded' => false, 'by_reference' => false, 'multiple' => false,"btn_add"=>false])
            ->add('encounters',CollectionType::class,
                [
                    //'foo' => ['class' => 'tinymce'],
                    "label"=>"encounters",
                    "btn_catalogue"=>false,
                    "btn_add"=>false,
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'btn_add' => false,
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
        ;
    }
}
