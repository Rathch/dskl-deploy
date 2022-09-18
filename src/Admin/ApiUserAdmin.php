<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Form\Type\RolesMatrixType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ApiUserAdmin extends AbstractAdmin
{
    /**
     * @var string
     */
    private const ID = 'id';

    /**
     * @var string
     */
    private const API_TOKEN = 'apiToken';

    /**
     * @var string
     */
    private const ROLES = 'roles';

    /**
     * @var string
     */
    private const PASSWORD = 'password';

    /**
     * @var string
     */
    private const USERNAME = 'username';

    /**
     * @var string
     */
    private const DESCRIPTION = 'description';

    /**
     * @var string
     */
    private const SALT = 'salt';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add(self::ID)
            ->add(self::API_TOKEN)
            ->add(self::ROLES)

            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add(self::ID)
            ->add(self::DESCRIPTION)
            ->add(self::API_TOKEN)

            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('general', ['class' => 'col-md-4'])
            ->add(self::API_TOKEN,null,[
            ])
            ->add(self::DESCRIPTION)
            ->end()
            ->with('roles', ['class' => 'col-md-8'])
            ->add('roles', RolesMatrixType::class, [
                'label' => false,
                'multiple' => true,
                'required' => false,
            ])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add(self::ID)
            ->add(self::API_TOKEN)
            ->add(self::ROLES)
            ->add(self::PASSWORD)
            ->add(self::USERNAME)
            ->add(self::DESCRIPTION)
            ->add(self::SALT)
            ;
    }
}
