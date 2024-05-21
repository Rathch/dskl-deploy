<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class ChampionshipEncounterAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('chanceTeam1')
            ->add('chanceTeam2')
            ->add('pointsTeam1')
            ->add('pointsTeam2')
            ->add('report')
            ->add('injuryTeam1Leicht')
            ->add('injuryTeam1Schwer')
            ->add('injuryTeam1Kritisch')
            ->add('injuryTeam1Tot')
            ->add('injuryTeam2Leicht')
            ->add('injuryTeam2Schwer')
            ->add('injuryTeam2Kritisch')
            ->add('injuryTeam2Tot')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('chanceTeam1')
            ->add('chanceTeam2')
            ->add('pointsTeam1')
            ->add('pointsTeam2')
            ->add('report')
            ->add('injuryTeam1Leicht')
            ->add('injuryTeam1Schwer')
            ->add('injuryTeam1Kritisch')
            ->add('injuryTeam1Tot')
            ->add('injuryTeam2Leicht')
            ->add('injuryTeam2Schwer')
            ->add('injuryTeam2Kritisch')
            ->add('injuryTeam2Tot')
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
        $form->with('general', ['class' => 'col-md-12'])
        ->end()
            ->with('Team 1', ['class' => 'col-md-6'])
                ->add('team1',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
                        'required' => false,
                        #'disabled'=>true,
                        'btn_add'=>false,
                        "label" => "Team 1"
                    ]
                )
                ->add('chanceTeam1', null, ["label" => "chanceTeam1"])
                ->add('injuryTeam1Leicht', null, ["label" => "injuryTeam1Leicht"])
                ->add('injuryTeam1Schwer', null, ["label" => "injuryTeam1Schwer"])
                ->add('injuryTeam1Kritisch', null, ["label" => "injuryTeam1Kritisch"])
                ->add('injuryTeam1Tot', null, ["label" => "injuryTeam1Tot"])
                ->add('pointsTeam1', null, ["label" => "pointsTeam1"])
            ->end()
            ->with('Team 2', ['class' => 'col-md-6'])
                ->add('team2',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
                        'required' => false,
                        #'disabled'=>true,
                        'btn_add'=>false,
                        "label" => "Team 2"
                    ]
                )
                ->add('chanceTeam2', null, ["label" => "chanceTeam2"])
                ->add('injuryTeam2Leicht', null, ["label" => "injuryTeam2Leicht"])
                ->add('injuryTeam2Schwer', null, ["label" => "injuryTeam2Schwer"])
                ->add('injuryTeam2Kritisch', null, ["label" => "injuryTeam2Kritisch"])
                ->add('injuryTeam2Tot', null, ["label" => "injuryTeam2Tot"])
                ->add('pointsTeam2', null, ["label" => "pointsTeam2"])
            ->end()
            ->with("report", ['class' => 'col-md-12'])
                ->add('report',TextareaType::class, [
                    "label" => "report",
                    'required' => false,
                    'attr' => ["class" => "summernote"],
                ])
            ->end()

            ;
    }
}
