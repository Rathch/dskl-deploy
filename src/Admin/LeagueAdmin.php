<?php

declare(strict_types=1);

namespace App\Admin;


use App\Service\GenerateEncounterService;
use App\Service\GenerateTeamStatisticService;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Show\ShowMapper;

final class LeagueAdmin extends AbstractAdmin
{
    private $generateEncounterService;
    private $generateTeamStatisticService;


    /**
     * @param GenerateEncounterService $generateEncounterService
     * @param GenerateTeamStatisticService $generateTeamStatisticService
     */
    public function __construct(GenerateEncounterService $generateEncounterService, GenerateTeamStatisticService $generateTeamStatisticService)
    {
        $this->generateEncounterService = $generateEncounterService;
        $this->generateTeamStatisticService = $generateTeamStatisticService;
        parent::__construct();
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('date')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('date',FieldDescriptionInterface::TYPE_DATETIME)
            ->add("playdays",FieldDescriptionInterface::TYPE_ONE_TO_MANY,[
                "associated_property"=>"id",
                'template' => 'CRUD/Association/list_pladay_one_to_many.html.twig'
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => false,
                    'delete' => false,
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('date', DateType::class, [
                    "widget"=>"choice",
                    'years' => range(2080,2099),
                    'format' => 'd MMMM yyyy',
            ]
            );
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('date')
            ;
    }


    protected function postPersist(object $object): void
    {
        $this->generateEncounterService->generate($object);
        $this->generateTeamStatisticService->generate($object);
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection
            ->remove("edit");
    }
}
