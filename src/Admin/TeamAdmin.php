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
        $this->getAdd($filter) ->add('active', null, ["label" => "active"]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $this->getAdd($list)
            ->add('active',FieldDescriptionInterface::TYPE_BOOLEAN,["label"=>"active"])
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
        $this->getAdd($form)
            ->add('active',null,["label"=>"active"])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $this->getAdd($show);
    }

    /**
     * @param $filter
     */
    protected function getAdd($filter)
    {
        $filter
            ->add('id', null, ["label" => "id"])
            ->add('name', null, ["label" => "name"])
            ->add('professionalism', null, ["label" => "professionalism"])
            ->add('brutality', null, ["label" => "brutality"])
            ->add('robustness', null, ["label" => "robustness"])
            ->add('offensive', null, ["label" => "offensive"])
            ->add('defensive', null, ["label" => "defensive"])
            ->add('tactics', null, ["label" => "tactics"])
            ->add('spirit', null, ["label" => "spirit"])
           ;
        return $filter;
    }
}
