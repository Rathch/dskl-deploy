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
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class LeagueAdmin extends AbstractAdmin
{
    private GenerateEncounterService $generateEncounterService;
    private GenerateTeamStatisticService $generateTeamStatisticService;


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

    /**
     * @param RouteCollectionInterface $collection
     * @return void
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove("edit");
        $collection->add('generateStatistic');
        $collection->add('regenerateStatistic');
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('seasonName')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id',null,["label"=>"id"])
            ->add('seasonName',null,["label"=>"seasonName"])
            ->add("playdays",FieldDescriptionInterface::TYPE_ONE_TO_MANY,[
                "label"=>"playdays",
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
            ->add('seasonName', TextType::class, [
                    "label"=>"seasonName"
            ]
            );
    }

    protected function configureShowFields(ShowMapper $show): void
    {

        $show
            ->add('id',null,["label"=>"id"])
            ->add('seasonName',null,["label"=>"seasonName"])
            ;
    }


    protected function postPersist(object $object): void
    {
        $this->generateEncounterService->generate($object);
        $this->generateTeamStatisticService->generate($object);
    }

    protected function configureActionButtons(array $buttonList, string $action, ?object $object = null): array
    {
        $buttonList['generateStatistic'] = ['template' => 'generateStatistic_button.html.twig'];
        $buttonList['regenerateStatistic'] = ['template' => 'regenerateStatistic_button.html.twig'];

        return $buttonList;
    }

    protected function configureDashboardActions(array $actions): array
    {
        $actions['generateStatistic'] = ['template' => 'generateStatistic_dashboard_button.html.twig'];
        $actions['regenerateStatistic'] = ['template' => 'regenerateStatistic_dashboard_button.html.twig'];

        return $actions;
    }
}
