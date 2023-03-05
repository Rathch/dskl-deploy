<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Retrospective;
use App\Entity\Squad;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\FileType;

final class TeamInfoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id',null,["label"=>"id"])
            ->add('city',null,["label"=>"city"])
            ->add('color',null,["label"=>"color"])
            ->add('foundingYear',null,["label"=>"foundingYear"])
            ->add('sponsor',null,["label"=>"sponsor"])
            ->add('presedent',null,["label"=>"presedent"])
            ->add('trainer',null,["label"=>"trainer"])
            ->add('successes',null,["label"=>"successes"])
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id',null,["label"=>"id"])

            ->add('city',null,["label"=>"city"])
            ->add('color',null,["label"=>"color"])
            ->add('foundingYear',null,["label"=>"foundingYear"])
            ->add('sponsor',null,["label"=>"sponsor"])
            ->add('presedent',null,["label"=>"presedent"])
            ->add('trainer',null,["label"=>"trainer"])
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
            //->add('team',null,["choice_label"=>"name","label"=>"team","disabled"=>true])
            ->add(
                'image',
                FileType::class,
                $this->addPrieview($this->getSubject(),["label"=>"image",'required' => false]))
            ->add('city',null,["label"=>"city"])
            ->add('color',null,["label"=>"color"])
            ->add('foundingYear',null,["label"=>"foundingYear"])
            ->add('sponsor',null,["label"=>"sponsor"])
            ->add('presedent',null,["label"=>"presedent"])
            ->add('trainer',null,["label"=>"trainer"])
            ->add('successes',CKEditorType::class,["label"=>"successes", "required"=>false])
            ->add('info',CKEditorType::class,["label"=>"info", "required"=>false])
            ->add('retrospectives',CollectionType::class,[
                "label"=>"Rückblick",
                "required"=>false,
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
            ])
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id',null,["label"=>"id"])
            //->add('image',null,["label"=>"image"])
            ->add('city',null,["label"=>"city"])
            ->add('color',null,["label"=>"color"])
            ->add('foundingYear',null,["label"=>"foundingYear"])
            ->add('sponsor',null,["label"=>"sponsor"])
            ->add('presedent',null,["label"=>"presedent"])
            ->add('trainer',null,["label"=>"trainer"])
            ->add('successes',null,["label"=>"successes"])
            ;
    }

    private function addPrieview($object, $fileFormOptions) {
        if ($object->getTeam()) {
            $fileFormOptions['help'] = '<img src="/img/teams/'.$object->getTeam()->getId()."/" .$object->getImageName(). '" with=100px height=100px class="admin-preview"/>';
            $fileFormOptions['help_html'] = true;
        }
        return $fileFormOptions;
    }
    protected function prePersist(object $object): void
    {

        $this->manageFileUpload($object);
    }

    protected function preUpdate(object $object): void
    {

        $this->manageFileUpload($object);
    }


    private function manageFileUpload(object $object): void
    {
        if ($object->getImage() !== null) {
            $thumbnailName = $object->getTeam()->getName();
            $thumbnailName = strtolower((string) $thumbnailName);
            $thumbnailName = trim($thumbnailName);
            $thumbnailName = str_replace(" ", "-", $thumbnailName);

            $object->setImageName($thumbnailName .  "." . $object->getImage()->guessExtension());

            $filesystem= new Filesystem();
            $filesystem->mkdir("/var/www/html/DsklAdministration/public/img/teams/".$object->getTeam()->getId());

            file_put_contents(  "/var/www/html/DsklAdministration/public/img/teams/".$object->getTeam()->getId()."/". $thumbnailName .  "." . $object->getImage()->guessExtension(), $object->getImage()->getContent());
        }
    }
}
