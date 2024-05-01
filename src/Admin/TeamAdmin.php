<?php

declare(strict_types=1);

namespace App\Admin;

use App\Doctrine\Enum\Flag;
use App\Entity\Affiliation;
use App\Entity\TeamAttributes;
use App\Entity\TeamInfo;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionProperty;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use function Webmozart\Assert\Tests\StaticAnalysis\null;


final class TeamAdmin extends AbstractAdmin
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
        $filter->add('id', null, ["label" => "id"]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id', null, ["label" => "id"])
            ->add('name', null, ["label" => "name"])
            ->add('description', FieldDescriptionInterface::TYPE_HTML, ["label" => "description"])
            ->add('affiliations', FieldDescriptionInterface::TYPE_MANY_TO_MANY, ["associated_property" => "name", "label" => "Zugehörigkeit"])
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
            ->tab('team')
                ->with('', ['class' => 'col-md-12'])
                    ->add('name', null, ["label" => "name"])
                    ->add('description', TextareaType::class, ["label" => "description", "required"=>true,'attr' => ["class" => "summernote"]])
                    ->add('active', EnumType::class, ["class"=>Flag::class,"label" => "active"])
                    ->add('affiliations', ModelType::class, [
                        'label' => 'Zugehörigkeit',
                        'class' => Affiliation::class,
                        'property' => 'name',
                        'expanded' => true,
                        'by_reference' => false,
                        'multiple' => true,
                        'btn_add' => false,
                    ])
                ->end()
            ->end()

            ->tab('attributes')
                ->with('', ['class' => 'col-md-12'])
                    ->add('teamAttributes', AdminType::class,
                        [
                            "label"=>"teamAttributes",
                        ]
                    )
                ->end()
            ->end()
        ;
        if ($this->getRequest()->getPathInfo() != "/admin/app/team/create") {
            $form
                ->tab('information')
                ->with('', ['class' => 'col-md-12'])
                ->add('teamInfo', AdminType::class,
                    [
                        "label"=>"teamInfo",
                        'mapped'   => true
                    ]
                )
                ->end()
                ->end()
                ->tab('squad')
                ->with('', ['class' => 'col-md-12'])
                ->add('squads', \Sonata\Form\Type\CollectionType::class, [
                    "label"=>"squads",
                    'type_options' => [
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'delete_options' => [
                            // You may otherwise choose to put the field but hide it
                            'type'         => 'hidden',
                            // In that case, you need to fill in the options as well
                            'type_options' => ['mapped'   => false, 'required' => false],
                        ],
                    ]
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
                ->end()
                ->end();
        }

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('name', null, ["label" => "name"]);
    }



    protected function prePersist(object $team): void
    {
        $teamInfo = new TeamInfo;
        $teamInfo->setTeam($team);
        $teamAttributs = new TeamAttributes();
        $teamAttributs->setTeam($team);
    }

    protected function preUpdate(object $object): void
    {
        $reflectionProperty = new ReflectionProperty(\App\Entity\TeamInfo::class, 'image');
        $teaminfo = $object->getTeamInfo();

        if ($reflectionProperty->isInitialized($teaminfo)) {
            $this->manageFileUpload($teaminfo);

        }

    }

    private function manageFileUpload(object $object): void
    {
        $filesystem= new Filesystem();
        #$filesystem->mkdir("/var/www/html/public/img/teams/".$object->getTeam()->getId());

        if (
            move_uploaded_file(
                $_FILES[
                $_REQUEST['uniqid']
                ]['tmp_name']['teamInfo']['image'],
                "/var/www/html/public/img/teams/".$object->getTeam()->getId()."/". $_FILES[$_REQUEST['uniqid']]['name']['teamInfo']['image']
            )
        ) {
            $object->setImageName($_FILES[$_REQUEST['uniqid']]['name']['teamInfo']['image']);

        }
    }
}
