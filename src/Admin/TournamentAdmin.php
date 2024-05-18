<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Tournament;
use App\Entity\TournamentEncounter;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\Form\Type\CollectionType;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Form\Type\ModelType;

final class TournamentAdmin extends AbstractAdmin
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('teamAmount')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('teamAmount')
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
            $form->tab('Turnier')
                ->with('', ['class' => 'col-md-12'])
                    ->add('name')
                ->end()
                ->with('', ['class' => 'col-md-6'])
                ->add('teamAmount', ChoiceType::class, [
                    'label' => 'Anzahl Teams',
                    'choices' => [
                    4 => 4,
                    8 => 8,
                    16 => 16,
                    32 => 32,
                    64 => 64,
                    ],
                    'required' => true
                ])
                ->end()
            ->end();

            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound1()) > 1 ) {
                $form->tab('Finale')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound1', CollectionType::class,
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
            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound2()) > 1 ) {
                $form->tab('Halbfinale')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound2', CollectionType::class,
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
            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound3()) > 1 ) {
                $form->tab('Viertelfinale')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound3', CollectionType::class,
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
            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound4()) > 1 ) {
                $form->tab('Achtelfinale')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound4', CollectionType::class,
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
            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound5()) > 1 ) {
                $form->tab('Runde 5')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound5', CollectionType::class,
                    [
                        "label" => "Runde 5",
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

            if ($this->getRequest()->getPathInfo() !== "/admin/app/tournament/create" && count($this->getSubject()->getEncounterRound6()) > 1 ) {
                $form->tab('Runde 6')
                    ->with('', ['class' => 'col-md-12'])
                    ->add('encounterRound6', CollectionType::class,
                    [
                        "label" => "Runde 6",
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
            ->add('teamAmount')
            ;
    }

    protected function prePersist(object $object): void
    {
        $this->generateGames($object);
    }

    protected function preUpdate(object $object): void
    {
        //$this->generateGamesMissing($object);
        //$this->deleteAdditionalGames($object);
    }

    private function getRoundsFromTeamAmound(int $teamAmount)
    {
        return intval(log($teamAmount, 2));
        //https://github.com/fletchto99/SEG2105-Final/blob/master/web/cgi-bin/entities/Tournament.php
    }

    private function generateGames(object $object)
    {
        $matches = [];
        $teamAmount = $object->getTeamAmount();
        $rounds =$this->getRoundsFromTeamAmound($teamAmount);
        //generate finaly
        $object->addEncounterRound1(new TournamentEncounter());
        array_push($matches, $rounds);
        $rounds--;

         //generate halffinaly
        $object->addEncounterRound2(new TournamentEncounter());
        $object->addEncounterRound2(new TournamentEncounter());
        $object->addEncounterRound2(new TournamentEncounter());
        $object->addEncounterRound2(new TournamentEncounter());
        $rounds--;

        if($rounds > 0) {
            //generate quarterfinaly
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $object->addEncounterRound3(new TournamentEncounter());
            $rounds--;
        }

        if($rounds > 0) {
            //generate octafinaly
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $object->addEncounterRound4(new TournamentEncounter());
            $rounds--;
        }

        if($rounds > 0) {
            //generate round five
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $object->addEncounterRound5(new TournamentEncounter());
            $rounds--;
        }
        
        //https://github.com/fletchto99/SEG2105-Final/blob/master/web/cgi-bin/entities/Tournament.php
    }

}
