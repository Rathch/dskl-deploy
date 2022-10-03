<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class TeamAttributesAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('professionalism', null, ["label" => "professionalism"])
            ->add('brutality', null, ["label" => "brutality"])
            ->add('robustness', null, ["label" => "robustness"])
            ->add('offensive', null, ["label" => "offensive"])
            ->add('defensive', null, ["label" => "defensive"])
            ->add('tactics', null, ["label" => "tactics"])
            ->add('spirit', null, ["label" => "spirit"])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('professionalism', null, ["label" => "professionalism"])
            ->add('brutality', null, ["label" => "brutality"])
            ->add('robustness', null, ["label" => "robustness"])
            ->add('offensive', null, ["label" => "offensive"])
            ->add('defensive', null, ["label" => "defensive"])
            ->add('tactics', null, ["label" => "tactics"])
            ->add('spirit', null, ["label" => "spirit"])
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

            ->add('professionalism', null, ["label" => "professionalism"])
            ->add('brutality', null, ["label" => "brutality"])
            ->add('robustness', null, ["label" => "robustness"])
            ->add('offensive', null, ["label" => "offensive"])
            ->add('defensive', null, ["label" => "defensive"])
            ->add('tactics', null, ["label" => "tactics"])
            ->add('spirit', null, ["label" => "spirit"])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('professionalism', null, ["label" => "professionalism"])
            ->add('brutality', null, ["label" => "brutality"])
            ->add('robustness', null, ["label" => "robustness"])
            ->add('offensive', null, ["label" => "offensive"])
            ->add('defensive', null, ["label" => "defensive"])
            ->add('tactics', null, ["label" => "tactics"])
            ->add('spirit', null, ["label" => "spirit"])
            ;
    }
}
