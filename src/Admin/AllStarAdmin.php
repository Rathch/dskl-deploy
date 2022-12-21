<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\League;
use App\Entity\Squad;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class AllStarAdmin extends AbstractAdmin
{

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
       /*     ->add('league',
                ModelType::class,
                [
                    "label"=>"Sesson",
                    "class"=>League::class,
                    "property"=>"seasonName",
                    'expanded' => true,
                    'by_reference' => false,
                    'multiple' => false,
                    "btn_add"=>false
                ]
            )*/
            ->add('allStarsMambers',
                ModelType::class,
                [
                    "label"=>"13 Besten Spieler Der Sesson",
                    "class"=>Squad::class,
                    "property"=>"fullInfo",
                    'expanded' => false,
                    'by_reference' => false,
                    'multiple' => true,
                    "btn_add"=>false
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
