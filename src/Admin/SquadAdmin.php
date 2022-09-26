<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Team;
use App\Entity\TeamInfo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class SquadAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('position')
            ->add('name')
            ->add('metatyp')
            ->add('age')
            ->add('comment')
            ->add('active')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id', null, ["label" => "id"])
            ->add('position', null, ["label" => "position"])
            ->add('name', null, ["label" => "name"])
            ->add('metatyp', null, ["label" => "metatyp"])
            ->add('age', null, ["label" => "age"])
            ->add('comment', null, ["label" => "comment"])
            ->add('active')
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
        $disabled = true;
        if ($this->getRequest()->getPathInfo() == "/admin/app/squad/".$this->getSubject()->getId()."/edit") {
            $disabled = false;
        }
        $form
            ->add('team',ModelType::class,
                [
                    "disabled"=>$disabled,
                    'class' => Team::class,
                    'property'=>'name',
                    'btn_add'=>false,
                    "label" => "Team"
                ]
            )
            ->add('position', null, ["label" => "position"])
            ->add('name', null, ["label" => "name"])
            ->add('metatyp', null, ["label" => "metatyp"])
            ->add('age', null, ["label" => "age"])
            ->add('comment', null, ["label" => "comment"])
            ->add('active', null, ["label" => "active"])

            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id', null, ["label" => "id"])
            ->add('position', null, ["label" => "position"])
            ->add('name', null, ["label" => "name"])
            ->add('metatyp', null, ["label" => "metatyp"])
            ->add('age', null, ["label" => "age"])
            ->add('description', null, ["label" => "description"])
            ->add('active', null, ["label" => "active"])
            ;
    }
}
