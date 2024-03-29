<?php

declare(strict_types=1);

namespace App\Admin;


use App\Entity\Team;
use App\Service\GenerateEncounterService;
use App\Service\GenerateTeamStatisticService;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\DoctrineORMAdminBundle\Model\ModelManager;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class LeagueAdmin extends AbstractAdmin
{
    private GenerateEncounterService $generateEncounterService;
    private GenerateTeamStatisticService $generateTeamStatisticService;


    private EntityManagerInterface $entityManager;

    public function __construct(
        GenerateEncounterService $generateEncounterService,
        GenerateTeamStatisticService $generateTeamStatisticService,
        EntityManagerInterface $entityManager
    ) {
        $this->generateEncounterService = $generateEncounterService;
        $this->generateTeamStatisticService = $generateTeamStatisticService;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    private function getTeamQueryBuilderByAffiliation(string $affiliation)
    {
        /** @var ModelManager $modelManager */
        $modelManager = $this->getModelManager();

        $teamRepository = $modelManager->getEntityManager(Team::class)->getRepository(Team::class);

        $queryBuilder = $teamRepository->createQueryBuilder('t')
            ->innerJoin('t.affiliations', 'a')
            ->where('a.id = :affiliation')
            ->setParameter('affiliation', $affiliation);

        return $queryBuilder;
    }

    /**
     * @param RouteCollectionInterface $collection
     * @return void
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        #$collection->remove("edit");
        $collection->add('generateStatistic');
        $collection->add('regenerateStatistic');
        $collection->add('resetTeams');
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
                    'edit' => [],
                    'delete' => false,
                    'resetTeams' => [
                        'template' => 'CRUD/list__action_resetTeams.html.twig',
                    ],
                    'generateStatistic' => [
                        'template' => 'CRUD/list__action_generateStatistic.html.twig',
                    ],
                    'regenerateStatistic' => [
                        'template' => 'CRUD/list__action_regenerateStatistic.html.twig',
                    ],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('seasonName', TextType::class, [
                    "label"=>"seasonName"
            ]
            )
            ->add('activeTeams', ModelType::class, [
                'label' => 'Aktive Teams',
                'class' => Team::class,
                'property' => 'name',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true,
                'btn_add' => false,
                'query' => $this->getTeamQueryBuilderByAffiliation('1'),
            ])
            ->add('allStars',AdminType::class,["label"=>"ADL Allstars"])
        ;
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



    protected function preRemove(object $object): void
    {
        $this->generateEncounterService->removeByLeauge($object);
        $this->generateTeamStatisticService->remove($object);
        parent::preRemove($object); // TODO: Change the autogenerated stub
    }
}
