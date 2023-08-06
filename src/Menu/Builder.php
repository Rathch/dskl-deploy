<?php

namespace App\Menu;

use App\Entity\Article;
use App\Entity\Page;
use App\Entity\Team;
use App\Repository\ArticleRepository;
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
use function Symfony\Component\Translation\t;


final class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    protected PageRepository $pageReposetory;
    protected TeamRepository $teamReposetory;
    protected ArticleRepository $articleRepository;

    public function __construct( private readonly FactoryInterface $factory, private readonly AuthorizationCheckerInterface $security, protected EntityManagerInterface $entityManager)
    {
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
        $this->articleReposetory = $entityManager->getRepository(Article::class);
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $teams = $this->teamReposetory->findAll();
        $pages = $this->pageReposetory->findAll();
        $articles = $this->articleReposetory->findAll();
        $menu = $this->factory->createItem('root');
        //$menu->addChild('Home', ['route' => 'home']);
        foreach ($pages as $page) {
            if ($page->getSlag() == "startseite") {
                $menu->addChild($page->getTitle(), ['route' => 'page', 'routeParameters' => ['title' => $page->getSlag()]]);
            }
        }
        $menu->addChild('Teams', ['route' => 'list_teams','routeParameters' => ['title' => "Teams"]]);
        $menu->addChild('Saison', ['route' => 'list_liga','routeParameters' => ['title' => "Saison"]]);
        $menu->addChild('Statistiken', ['route' => 'statistics','routeParameters' => ['title' => "Statistiken"]]);

        if ($articles) {
            $menu->addChild('Wipeout!-Magazin', ['route' => 'list_article','routeParameters' => ['title' => "Wipeout!-Magazin"]]);
        }

        //$menu->addChild('Statistiken', ['route' => 'statistics']);
        foreach ($pages as $page) {
            if ($page->getSlag() != "startseite") {
                $menu->addChild($page->getTitle(), ['route' => 'page', 'routeParameters' => ['title' => $page->getSlag()]]);
            }
        }
        foreach ($teams as $team) {
            $menu['Teams']->addChild($team->getName(), ['route' => 'show_team', 'routeParameters' => ['id' => $team->getId()]]);
        }
        $renderer = new ListRenderer(new Matcher());
        $renderer->render($menu, ['currentAsLink' => false]);

        return $menu;
    }

    public function createFooterMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild('Impressum', ['route' => 'impressum']);
        $menu->addChild('Datenschutz', ['route' => 'datenschutz']);
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
