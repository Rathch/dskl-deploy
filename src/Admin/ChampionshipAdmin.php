<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\Form\Type\CollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\ChampionshipEncounter;
use App\Entity\Tournament;
use App\Entity\TournamentEncounter;

final class ChampionshipAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('date')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('date')
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
        $form->tab('Meisterschaft')
        ->with('', ['class' => 'col-md-12'])
            ->add('name')
            ->add('date', DateType::class, [
                "label"=>"date",
                'widget' => 'single_text',
                'required' => false,
                #"widget"=>"choice",
                'years' => range(2080, 2090),
                #'format' => 'd MMMM yyyy',
            ])
        ->end()
        ->with('', ['class' => 'col-md-6'])
        
        ->end()
    ->end();

    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create") {
        $form->tab('Gruppe 1')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe1', CollectionType::class,
            [
                "label" => "Gruppe1",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 2')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe2', CollectionType::class,
            [
                "label" => "Gruppe 2",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 3')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe3', CollectionType::class,
            [
                "label" => "Gruppe 3",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 4')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe4', CollectionType::class,
            [
                "label" => "Gruppe 4",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 5')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe5', CollectionType::class,
            [
                "label" => "Gruppe 5",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 6')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe6', CollectionType::class,
            [
                "label" => "Gruppe 6",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 7')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe7', CollectionType::class,
            [
                "label" => "Gruppe 7",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create" ) {
        $form->tab('Gruppe 8')
            ->with('', ['class' => 'col-md-12'])
            ->add('championshipEncounterGroupe8', CollectionType::class,
            [
                "label" => "Gruppe 8",
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
    };
    
    
   
    
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create") {
        $form->tab('Achtelfinale')
            ->with('', ['class' => 'col-md-12'])
            ->add('tournament.encounterRound4', CollectionType::class,
            [
                "label" => "Achtelfinale",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create") {
        $form->tab('Viertelfinale')
            ->with('', ['class' => 'col-md-12'])
            ->add('tournament.encounterRound3', CollectionType::class,
            [
                "label" => "Viertelfinale",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create") {
        $form->tab('Halbfinale')
            ->with('', ['class' => 'col-md-12'])
            ->add('tournament.encounterRound2', CollectionType::class,
            [
                "label" => "Halbfinale",
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
    };
    if ($this->getRequest()->getPathInfo() !== "/admin/app/championship/create") {
        $form->tab('Finale')
            ->with('', ['class' => 'col-md-12'])
            ->add('tournament.encounterRound1', CollectionType::class,
            [
                "label" => "Finale",
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
    };
   
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('date')
        ;
    }

    protected function prePersist(object $object): void
    {
        $this->generateGroupeEncounter($object);
        $this->generateGames($object);
    }

    protected function preUpdate(object $object): void
    {
        $this->generateGroupeEncounter($object);
        $this->generateGames($object);
    }

    protected function generateGroupeEncounter(object $object): void
    {
        if (count($object->getChampionshipEncounterGroupe1()) < 6) {
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe1(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe2()) < 6) {
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe2(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe3()) < 6) {
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe3(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe4()) < 6) {
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe4(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe5()) < 6) {
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe5(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe6()) < 6) {
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe6(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe7()) < 6) {
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe7(new ChampionshipEncounter());
        }
        if (count($object->getChampionshipEncounterGroupe8()) < 6) {
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
            $object->addChampionshipEncounterGroupe8(new ChampionshipEncounter());
        }
    }


    private function generateGames(object $object)
    {
        if($object->getTournament() === null) {
            $tournament = new Tournament;
            $tournament->setTeamAmount(8);
            $tournament->setName($object->getName());
    
            $object->setTournament($tournament);
       }
    
        if(count($object->getTournament()->getEncounterRound1()) == 0) {
            //generate finaly
            $object->getTournament()->addEncounterRound1(new TournamentEncounter());
       }


        if(count($object->getTournament()->getEncounterRound2()) == 0) {
             //generate halffinaly
             $object->getTournament()->addEncounterRound2(new TournamentEncounter());
             $object->getTournament()->addEncounterRound2(new TournamentEncounter());
        }
  

        if(count($object->getTournament()->getEncounterRound3()) == 0) {
            //generate quarterfinaly
            $object->getTournament()->addEncounterRound3(new TournamentEncounter());
            $object->getTournament()->addEncounterRound3(new TournamentEncounter());
            $object->getTournament()->addEncounterRound3(new TournamentEncounter());
            $object->getTournament()->addEncounterRound3(new TournamentEncounter());
        }
        if(count($object->getTournament()->getEncounterRound4()) == 0) {
            //generate octerfinaly
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
            $object->getTournament()->addEncounterRound4(new TournamentEncounter());
        }

        
        //https://github.com/fletchto99/SEG2105-Final/blob/master/web/cgi-bin/entities/Tournament.php
    }

}
