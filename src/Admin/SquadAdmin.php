<?php

declare(strict_types=1);

namespace App\Admin;

use App\Doctrine\Enum\Flag;
use App\Doctrine\Enum\MethaTyp;
use App\Doctrine\Enum\Position;
use App\Entity\Team;
use App\Entity\TeamInfo;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;

final class SquadAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('active')
            ->add('firstName')
            ->add('figthName')
            ->add('name')


            ->add('position', null, [
                'field_type' => EnumType::class,
                'field_options' => [
                    'class' => Position::class,
                    'choice_label' => 'value',
                ],
            ])
            ->add('methaTyp', null, [
                'field_type' => EnumType::class,
                'field_options' => [
                    'class' => MethaTyp::class,
                    'choice_label' => 'value',
                ],
            ])
            ->add('comment')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id', null, ["label" => "id"])
            ->add('active', FieldDescriptionInterface::TYPE_ENUM, ["label" => "active"])
            ->add('firstName', null, ["label" => "firstName"])
            ->add('figthName', null, ["label" => "figthName"])
            ->add('name', null, ["label" => "name"])
            ->add('team', FieldDescriptionInterface::TYPE_MANY_TO_ONE, ["associated_property"=>"name","label" => "team"])
            ->add('transfers', FieldDescriptionInterface::TYPE_ONE_TO_MANY, ["associated_property"=>"oldTeam.name","label" => "Transfer Historie"])
            ->add('position', FieldDescriptionInterface::TYPE_ENUM, ["label" => "position"])
            ->add('methaTyp', FieldDescriptionInterface::TYPE_ENUM, ["label" => "metatyp"])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'transfer' => [
                        'template' => 'CRUD/list__action_transfer.html.twig',
                    ],
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
            ->add('firstName', null, ["label" => "firstName"])
            ->add('figthName', null, ["label" => "figthName"])
            ->add('name', null, ["label" => "name"])
            ->add('methaTyp', EnumType::class, ["class"=>MethaTyp::class,"choice_label"=>"value","label" => "metatyp"])
            ->add('birthYear', null, ["label" => "birthYear"])
            ->add('gender', ChoiceType::class, ["choices"=>["M"=>"M","W"=>"W","D"=>"D"],"label" => "gender"])
            ->add('value', null, ["label" => "value"])
            ->add('comment', CKEditorType::class, ["label" => "comment", "required"=>false])
            ->add('replacement', null, ["label" => "replacement"])
            ->add('dead', null, ["label" => "Verstorben"])
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



    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection
            ->add('transfer', $this->getRouterIdParameter().'/transfer');
    }
}
