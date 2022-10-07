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
    protected TeamRepository $teamReposetory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct( FactoryInterface $factory, AuthorizationCheckerInterface $security, EntityManagerInterface $entityManager)
    {
        $this->factory = $factory;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $teams = $this->teamReposetory->findAll();
        $pages = $this->pageReposetory->findAll();
        $menu = $this->factory->createItem('root');
        $menu->addChild('Home', ['route' => 'home']);
        $menu->addChild('Teams', ['route' => 'list_teams']);
        $menu->addChild('Liga', ['route' => 'list_liga']);
        foreach ($pages as $page) {
            $menu->addChild($page->getTitle(), ['route' => 'page', 'routeParameters' => ['title' => $page->getSlag()]]);
        }
        foreach ($teams as $team) {
            $menu['Teams']->addChild($team->getName(), ['route' => 'show_team', 'routeParameters' => ['id' => $team->getId()]]);
        }
        $renderer = new ListRenderer(new Matcher());
        $renderer->render($menu, ['currentAsLink' => false]);

        return $menu;
    }

    public function createTeamMenu(RequestStack $requestStack)
    {
        $teams = $this->teamReposetory->findAll();
        $menu = $this->factory->createItem('root');
        foreach ($teams as $team) {
            $menu->addChild($team->getName(), ['route' => 'show_team', 'routeParameters' => ['id' => $team->getId()]]);
        }
        $renderer = new ListRenderer(new Matcher());
        $renderer->render($menu, ['currentAsLink' => false]);

        return $menu;
    }
}