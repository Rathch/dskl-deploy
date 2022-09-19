<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class TeamAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('professionalism')
            ->add('brutality')
            ->add('robustness')
            ->add('offensive')
            ->add('defensive')
            ->add('tactics')
            ->add('spirit')
            ->add('power')
            ->add('active')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('professionalism')
            ->add('brutality')
            ->add('robustness')
            ->add('offensive')
            ->add('defensive')
            ->add('tactics')
            ->add('spirit')
            ->add('power')
            ->add('active',FieldDescriptionInterface::TYPE_BOOLEAN)
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
            ->add('name')
            ->add('professionalism')
            ->add('brutality')
            ->add('robustness')
            ->add('offensive')
            ->add('defensive')
            ->add('tactics')
            ->add('spirit')
            ->add('active')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('professionalism')
            ->add('brutality')
            ->add('robustness')
            ->add('offensive')
            ->add('defensive')
            ->add('tactics')
            ->add('spirit')
            ->add('power')
            ->add('active')
            ;
    }
}
