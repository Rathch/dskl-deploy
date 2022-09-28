<?php

declare(strict_types=1);

namespace App\Admin;

use App\Doctrine\Enum\Flag;
use App\Doctrine\Enum\Position;
use App\Entity\Team;
use App\Entity\TeamInfo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

final class SquadAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('active')

            ->add('name')
            ->add('position', null, [
                'field_type' => EnumType::class,
                'field_options' => [
                    'class' => Position::class,
                    'choice_label' => 'value',
                ],
            ])
            ->add('metatyp')
            ->add('age')
            ->add('comment')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id', null, ["label" => "id"])
            ->add('active', FieldDescriptionInterface::TYPE_ENUM, ["label" => "active"])
            ->add('name', null, ["label" => "name"])
            ->add('position', FieldDescriptionInterface::TYPE_ENUM, ["label" => "position"])
            ->add('metatyp', null, ["label" => "metatyp"])
            ->add('age', null, ["label" => "age"])
            ->add('comment', null, ["label" => "comment"])
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

        if ($this->getRequest()->getPathInfo() == "/admin/app/squad/".$this->getSubject()->getId()."/edit") {
            $form
                ->add('team',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
                        'btn_add'=>false,
                        "label" => "Team"
                    ]
                );
        }
        $form
            ->add('position', EnumType::class, ["class"=>Position::class,"choice_label"=>"value","label" => "position"])
            ->add('name', null, ["label" => "name"])
            ->add('metatyp', null, ["label" => "metatyp"])
            ->add('age', null, ["label" => "age"])
            ->add('value', null, ["label" => "value"])
            ->add('comment', null, ["label" => "comment"])
            ->add('replacement', null, ["label" => "replacement"])
            ->add('active', EnumType::class, ["class"=>Flag::class,"label" => "active"])
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
