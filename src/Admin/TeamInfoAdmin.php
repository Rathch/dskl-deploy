<?php

declare(strict_types=1);

namespace App\Admin;


use App\Entity\TeamInfo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('president',null,["label"=>"president"])
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
            ->add('president',null,["label"=>"president"])
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
            ->add(
                'image',
                FileType::class,
                $this->addPrieview($this->getSubject(),
                    [
                        "label"=>"image",
                        'required' => false,
                        'disabled' => true,
                        'mapped' => false,
                        'data_class'=>TeamInfo::class,
                        'constraints' => [
                            new File([
                                'maxSize' => '1024k',
                                'mimeTypes' => [
                                    'image/apng',
                                    'image/avif',
                                    'image/gif',
                                    'image/jpeg',
                                    'image/png',
                                    'image/svg+xml',
                                    'image/webp',
                                ],
                                'mimeTypesMessage' => 'Please upload a valid image document',
                            ])
    ],
                        ] ))
            ->add('city',null,["label"=>"city"])
            ->add('color',null,["label"=>"color"])
            ->add('foundingYear',null,["label"=>"foundingYear"])
            ->add('sponsor',null,["label"=>"sponsor"])
            ->add('president',null,["label"=>"president"])
            ->add('trainer',null,["label"=>"trainer"])
            ->add('successes',TextareaType::class,["label"=>"successes", "required"=>false, 'attr' => ["class" => "summernote"]])
            ->add('info',TextareaType::class,["label"=>"info", "required"=>false, 'attr' => ["class" => "summernote"]])
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
            ->add('president',null,["label"=>"president"])
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
        $filesystem= new Filesystem();
        $filesystem->mkdir("/var/www/html/public/img/teams/".$object->getTeam()->getId());

        if (
            move_uploaded_file(
                $_FILES[
                    $_REQUEST['uniqid']
                ]['tmp_name']['image'],
                "/var/www/html/public/img/teams/".$object->getTeam()->getId()."/". $_FILES[$_REQUEST['uniqid']]['name']['image']
            )
        ) {
            $object->setImageName($_FILES[$_REQUEST['uniqid']]['name']['image']);

        }
    }
}
