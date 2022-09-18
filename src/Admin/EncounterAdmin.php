<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Encounter;
use App\Entity\PlayDay;
use App\Entity\Team;
use App\Service\GenerateEncounterService;
use App\Service\GenerateTeamStatisticService;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use JetBrains\PhpStorm\NoReturn;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

final class EncounterAdmin extends AbstractAdmin
{
    private $generateEncounterService;
    private $generateTeamStatisticService;


    /**
     *
     * @param GenerateTeamStatisticService $generateTeamStatisticService
     */
    public function __construct( GenerateTeamStatisticService $generateTeamStatisticService)
    {
        $this->generateTeamStatisticService = $generateTeamStatisticService;
        parent::__construct();
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')

            ->add('report')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('team1',FieldDescriptionInterface::TYPE_MANY_TO_ONE,["associated_property"=>"name",])
            ->add('pointsTeam1',FieldDescriptionInterface::TYPE_INTEGER)
            ->add('team2',FieldDescriptionInterface::TYPE_MANY_TO_ONE,["associated_property"=>"name",])
            ->add('pointsTeam2')
            ->add('report',FieldDescriptionInterface::TYPE_HTML)
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
            ->with('Playday', ['class' => 'col-md-12'])
                ->add('playday',ModelType::class,
                    [
                        'class' => PlayDay::class,
                        'property'=>'id',
                        'disabled'=> true
                    ]
                )
            ->end()
            ->with('Team 1', ['class' => 'col-md-6'])
                ->add('team1',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
                        'disabled'=>true,
                        'btn_add'=>false
                    ]
                )
                ->add('chanceTeam1')
                ->add('injuryTeam1Leicht')
                ->add('injuryTeam1Schwer')
                ->add('injuryTeam1Kritisch')
                ->add('injuryTeam1Tot')
                ->add('pointsTeam1')
            ->end()
            ->with('Team 2', ['class' => 'col-md-6'])
                ->add('team2',ModelType::class,
                    [
                        'class' => Team::class,
                        'property'=>'name',
                        'disabled'=>true,
                        'btn_add'=>false
                    ]
                )
                ->add('chanceTeam2')
                ->add('injuryTeam2Leicht')
                ->add('injuryTeam2Schwer')
                ->add('injuryTeam2Kritisch')
                ->add('injuryTeam2Tot')
                ->add('pointsTeam2')
            ->end()
            ->with("", ['class' => 'col-md-12'])
                ->add('report',CKEditorType::class, [
                    'config' => array('toolbar' => "basic")
                ])
            ->end()

            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('chanceT1')
            ->add('chanceT2')
            ->add('injuryT1L')
            ->add('injuryT2L')
            ->add('report')
            ;
    }

    #[NoReturn] protected function postUpdate(object $object): void
    {
        /** @var Encounter $object */
        $this->generateTeamStatisticService->update($object);
    }
}
