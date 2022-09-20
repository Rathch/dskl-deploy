<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Encounter;
use App\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


final class PlayDayAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id',null,["label"=>"id"])
            ->add('date',null,["label"=>"date"])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id',null,["label"=>"id"])
            /*->add('league',FieldDescriptionInterface::TYPE_MANY_TO_ONE,[
                "associated_property"=>"id"
            ])*/
            ->add('league',FieldDescriptionInterface::TYPE_MANY_TO_ONE,[
                "associated_property"=>"id",
                "label"=>"league"
            ])
            ->add('date',null,["label"=>"date"])
            ->add('encounters',FieldDescriptionInterface::TYPE_ONE_TO_MANY,[
                "label"=>"encounters",
                "associated_property"=>"id",
                'template' => 'CRUD/Association/list_encounter_one_to_many.html.twig'
            ])
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
            ->with('Playday', ['class' => 'col-md-12'])
                ->add('date', DateType::class, [
                    "label"=>"date",
                    "widget"=>"choice",
                    'years' => range(2080,2099),
                    'format' => 'd MMMM yyyy',
                ])
            ->end()
            ->with('Encounters', ['class' => 'col-md-12'])
                ->add('encounters',CollectionType::class,
                    [
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
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id',null,["label"=>"id"])
            ->add('date',null,["label"=>"date"])
            ;
    }
}
