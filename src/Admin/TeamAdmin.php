<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Squad;
use App\Entity\TeamAttributes;
use App\Entity\TeamInfo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\FieldDescription\FieldDescription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

final class TeamAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $this->getAdd($filter)->add('id', null, ["label" => "id"]) ->add('active', null, ["label" => "active"]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $this->getAdd($list)->add('id', null, ["label" => "id"])
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


        $form
            ->tab('team')
                ->with('', ['class' => 'col-md-12'])
                    ->add('name', null, ["label" => "name"])
                    ->add('active', null, ["label" => "active"])
                ->end()
            ->end()
            ->tab('information')
            ->with('', ['class' => 'col-md-12'])
            ->add('teamInfo', AdminType::class,
                [
                    "label"=>"teamInfo",
                ]
            )
            ->end()
            ->end()
            ->tab('attributes')
                ->with('', ['class' => 'col-md-12'])
                    ->add('teamAttributes', AdminType::class,
                        [
                            "label"=>"teamAttributes",
                        ]
                    )
                ->end()
            ->end()
        ;
        if ($this->getRequest()->getPathInfo() != "/admin/app/team/create") {
            $form ->tab('squad')
                ->with('', ['class' => 'col-md-12'])
                ->add('squads', \Sonata\Form\Type\CollectionType::class, [
                    "label"=>"squads",
                    "btn_catalogue"=>true,

                    'type_options' => [

                    ]
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
                ->end()
                ->end();
        }

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
            ->add('name', null, ["label" => "name"])
           ;
        return $filter;
    }

    protected function prePersist(object $team): void
    {
        $teamInfo = new TeamInfo;
        $teamInfo->setTeam($team);
        $teamAttributs = new TeamAttributes();
        $teamAttributs->setTeam($team);
    }
}
