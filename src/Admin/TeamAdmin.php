<?php

declare(strict_types=1);

namespace App\Admin;

use App\Doctrine\Enum\Flag;
use App\Entity\TeamAttributes;
use App\Entity\TeamInfo;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use ReflectionProperty;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use function Webmozart\Assert\Tests\StaticAnalysis\null;


final class TeamAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('id', null, ["label" => "id"]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id', null, ["label" => "id"])
            ->add('name', null, ["label" => "name"])
            ->add('description', null, ["label" => "description"])
            ->add('active', FieldDescriptionInterface::TYPE_ENUM, ["label" => "active"])
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
                    ->add('description', CKEditorType::class, ["label" => "description", "required"=>false])
            ->add('active', EnumType::class, ["class"=>Flag::class,"label" => "active"])
                ->end()
            ->end()
            ->tab('information')
            ->with('', ['class' => 'col-md-12'])
            ->add('teamInfo', AdminType::class,
                [
                    "label"=>"teamInfo",
                ]
            )
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
            $form ->tab('squad')
                ->with('', ['class' => 'col-md-12'])
                ->add('squads', \Sonata\Form\Type\CollectionType::class, [
                    "label"=>"squads",
                    'type_options' => array(
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'delete_options' => array(
                            // You may otherwise choose to put the field but hide it
                            'type'         => 'hidden',
                            // In that case, you need to fill in the options as well
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    )
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
        $reflectionProperty = new ReflectionProperty("App\Entity\TeamInfo", 'image');
        $teaminfo = $object->getTeamInfo();
        if ($reflectionProperty->isInitialized($teaminfo)) {
            $thumbnailName = $teaminfo->getTeam()->getName();
            $thumbnailName = strtolower($thumbnailName);
            $thumbnailName = trim($thumbnailName);
            $teaminfo->setImageName($thumbnailName .  "." . $teaminfo->getImage()->guessExtension());

            $filesystem= new Filesystem();
            $filesystem->mkdir("/var/www/html/public/img/teams/".$teaminfo->getTeam()->getId());

            file_put_contents(  "/var/www/html/public/img/teams/".$teaminfo->getTeam()->getId()."/". $thumbnailName .  "." . $teaminfo->getImage()->guessExtension(), $teaminfo->getImage()->getContent());
        }

    }
}
