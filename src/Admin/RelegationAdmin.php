<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\League;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;

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
            ->add('league',FieldDescriptionInterface::TYPE_MANY_TO_ONE,[
                "associated_property"=>"seasonName",
                "label"=>"league"
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
        $form->tab('Season')
                ->with('', ['class' => 'col-md-12'])
                    ->add('league',ModelType::class,["label"=>"league","class"=>League::class,"property"=>"seasonName", 'expanded' => false, 'by_reference' => false, 'multiple' => false,"btn_add"=>false])
                ->end()
            ->end()
            ->tab('Hinspiele')
                ->with('', ['class' => 'col-md-12'])
                    ->add('encounters',CollectionType::class,
                [
                    "label"=>"hinspiele",
                    "btn_catalogue"=>false,
                    "btn_add"=>false,
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'btn_add' => false,
                    ]
                ], [
                        'edit' => 'inline',
                        #'inline' => 'natural'
                        'inline' => 'table'
                ]
            )
                ->end()
            ->end();

        if ($this->getRequest()->getPathInfo() !== "/admin/app/relegation/create") {
            $form->tab('Rueckspiele')
                ->with('', ['class' => 'col-md-12'])
                ->add('encounters2', CollectionType::class,
                    [
                        "label" => "rückspiele",
                        "btn_catalogue" => false,
                        "btn_add" => false,
                        'type_options' => [
                            // Prevents the "Delete" option from being displayed
                            'delete' => false,
                            'btn_add' => false,
                        ]
                    ], [
                        'edit' => 'inline',
                        #'inline' => 'natural'
                        'inline' => 'table'
                    ]
                )
                ->end()
                ->end();
        }
    }


    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
        ;
    }

    protected function prePersist(object $object): void
    {
        $this->generateOpositGames($object);
    }

    protected function preUpdate(object $object): void
    {

    }


    private function generateOpositGames(object $object)
    {
        $firstLegs = $object->getEncounters();
        $secondLegs = $object->getEncounters2();
        foreach ($firstLegs as $position => $firstLegs) {
            $secondLegs[$position]->setTeam1($firstLegs->getTeam2());
            $secondLegs[$position]->setTeam2($firstLegs->getTeam1());
        }
    }
}
