<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\Page;
use App\Entity\Team;
use App\Entity\TeamStatistic;
use App\Entity\TransferHistory;
use App\Repository\ArticleRepository;
use App\Repository\EncounterRepository;
use App\Repository\LeagueRepository;
use App\Repository\PageRepository;
use App\Repository\TeamRepository;
use App\Repository\TeamStatisticRepository;
use App\Repository\TransferHistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    protected PageRepository $pageReposetory;
    protected TeamRepository $teamReposetory;
    protected TeamStatisticRepository $teamStatisticReposetory;
    protected LeagueRepository $ligaReposetory;
    protected ArticleRepository $articleReposetory;
    protected EncounterRepository $encounterRepository;
    protected TransferHistoryRepository $transferHistoryRepository;


    public function __construct( protected EntityManagerInterface $entityManager)
    {
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
        $this->teamStatisticReposetory = $entityManager->getRepository(TeamStatistic::class);
        $this->ligaReposetory = $entityManager->getRepository(League::class);
        $this->articleReposetory = $entityManager->getRepository(Article::class);
        $this->encounterRepository = $entityManager->getRepository(Encounter::class);
        $this->transferHistoryRepository = $entityManager->getRepository(TransferHistory::class);
    }



    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $title = "startseite";
        $page = $this->pageReposetory->findOneBy(["slag"=>$title]);

        return $this->render('page/content.html.twig', [
            'page' => $page,
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/datenschutz', name: 'datenschutz')]
    public function datenschutz(): Response
    {
        return $this->render('page/datenschutz.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/impressum', name: 'impressum')]
    public function impressum(): Response
    {
        return $this->render('page/impressum.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/page/{title}', name: 'page')]
    public function page($title): Response
    {
        $page = $this->pageReposetory->findOneBy(["slag"=>$title]);

        return $this->render('page/content.html.twig', [
            'page' => $page,
            'controller_name' => 'PageController',
        ]);
    }
    #[Route(path: '/team/list', name: 'list_teams')]
    public function listTeam(): Response
    {
        $teams = $this->teamReposetory->findAll();
        return $this->render('page/team.list.html.twig', [
            'teams' => $teams,
            'controller_name' => 'PageController',
        ]);
    }

    #[Route(path: '/team/show/{id}', name: 'show_team')]
    public function showTeam($id): Response
    {
        $team = $this->teamReposetory->findOneBy(["id"=>$id]);
        $transferHistory = $this->transferHistoryRepository->findAll();
        return $this->render('page/team.show.html.twig', [
            'controller_name' => 'PageController',
            'team' => $team,
            'transfers' => $transferHistory,
        ]);
    }

    #[Route(path: '/liga/list', name: 'list_liga')]
    public function listLiga(): Response
    {
        $ligas = $this->ligaReposetory->findAll();
        return $this->render('page/liga.list.html.twig', [
            'ligas' => $ligas,
            'controller_name' => 'PageController',
        ]);
    }

    #[Route(path: '/Wipeout-Magazin', name: 'list_article')]
    public function listarticle(): Response
    {
        $article = $this->articleReposetory->findAll();
        return $this->render('page/list.article.html.twig', [
            'articles' => $article,
            'controller_name' => 'PageController',
        ]);
    }

    #[Route(path: '/statistics', name: 'statistics')]
    public function statistics(): Response
    {
        $ligas = $this->encounterRepository->findBy("kills",10);
        return $this->render('page/statistics.html.twig', [
            'ligas' => $ligas,
            'controller_name' => 'PageController',
        ]);
    }

    #[Route(path: '/liga/show/{id}', name: 'show_liga')]
    public function showLiga($id): Response
    {
        $liga = $this->ligaReposetory->findOneBy(["id"=>$id]);
        //find and sort teamstatistics
        $statistics = $this->teamStatisticReposetory->findBy(
            [
                "league"=>$liga
            ],
            [
                "points"=>"DESC",
                "goaleDifference"=>"DESC",
                "goales"=>"DESC"
            ]
        );
        return $this->render('page/liga.show.html.twig', [
            'controller_name' => 'PageController',
            'liga' => $liga,
            'statistics'=>$statistics,
        ]);
    }
}
