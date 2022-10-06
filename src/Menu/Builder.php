<?php

namespace App\Menu;

use App\Entity\Page;
use App\Entity\Team;
use App\Repository\PageRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Renderer\ListRenderer;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $factory;
    private $security;
    protected EntityManagerInterface $entityManager;
    protected PageRepository $pageReposetory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct( FactoryInterface $factory, AuthorizationCheckerInterface $security, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->pageReposetory = $entityManager->getRepository(Page::class);
    }

    public function createMainMenu(RequestStack $requestStack)
    {

        $pages = $this->pageReposetory->findAll();
        $menu = $this->factory->createItem('root');
        $menu->addChild('Home', ['route' => 'home']);
        $menu->addChild('Teams', ['route' => 'list_teams']);
        foreach ($pages as $page) {
            $menu->addChild($page->getTitle(), ['route' => 'page', 'routeParameters' => ['title' => $page->getSlag()]]);
        }
        $renderer = new ListRenderer(new Matcher());
        $renderer->render($menu, ['currentAsLink' => false]);

        return $menu;
    }
}