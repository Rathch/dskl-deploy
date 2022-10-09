<?php

declare(strict_types=1);

namespace App\Admin;

use App\Utility\StringUtility;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class PageAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html')
            ->add('templatename')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html',TextareaType::class,[
            '   row_attr' => ['id' => 'editor'],
            ])
            ->add('templatename')
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
            ->add('title')
            ->add('slag')
            ->add('html')
            ->add('templatename')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('title')
            ->add('slag')
            ->add('html')
            ->add('templatename')
            ;
    }

    protected function prePersist(object $object): void
    {
        $object->setSlag(StringUtility::prepareStringForUrl($object->getTitle()));
    }

    protected function preUpdate(object $object): void
    {
        $object->setSlag(StringUtility::prepareStringForUrl($object->getTitle()));
    }
}
