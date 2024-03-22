<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\RelegationEncounter;
use App\Entity\Team;
use App\Service\GenerateTeamStatisticService;
use JetBrains\PhpStorm\NoReturn;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class RelegationEncounterAdmin extends AbstractAdmin
{
    /**
     *
     * @param GenerateTeamStatisticService $generateTeamStatisticService
     */
    public function __construct( private readonly GenerateTeamStatisticService $generateTeamStatisticService)
    {
        parent::__construct();
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id', null, ["label" => "id"])
            ->add('report', null, ["label" => "report"])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('team1',FieldDescriptionInterface::TYPE_MANY_TO_ONE,["associated_property"=>"name","label" => "team1"])
            ->add('pointsTeam1',FieldDescriptionInterface::TYPE_INTEGER,["label" => "pointsTeam1"])
            ->add('team2',FieldDescriptionInterface::TYPE_MANY_TO_ONE,["associated_property"=>"name","label" => "Team 2"])
            ->add('pointsTeam2',FieldDescriptionInterface::TYPE_INTEGER,["label" => "pointsTeam2"])
            ->add('report',FieldDescriptionInterface::TYPE_HTML,["label" => "report"])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => false,
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form->with('Date', ['class' => 'col-md-12'])
        ->add('date', DateType::class, [
            "label"=>"date",
            'widget' => 'single_text',
            #"widget"=>"choice",
            'years' => range(2080, 2090),
            #'format' => 'd MMMM yyyy',
        ])
        ->end()
            ->with('Team 1', ['class' => 'col-md-6'])
                ->add('team1',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
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
                    'attr' => ["class" => "summernote"],
                ])
            ->end()

            ;
    }


    #[NoReturn] protected function postUpdate(object $object): void
    {
        /** @var RelegationEncounter $object */
        $this->generateTeamStatisticService->update($object);
    }
}
