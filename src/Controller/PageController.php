<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\Page;
use App\Entity\Squad;
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
use Doctrine\Common\Collections\Criteria;

class PageController extends AbstractController
{
    protected PageRepository $pageReposetory;
    protected TeamRepository $teamReposetory;
    protected TeamStatisticRepository $teamStatisticReposetory;
    protected LeagueRepository $ligaReposetory;
    protected ArticleRepository $articleReposetory;
    protected EncounterRepository $encounterRepository;
    protected TransferHistoryRepository $transferHistoryRepository;
    protected SquadRepository $squadRepository;


    public function __construct( protected EntityManagerInterface $entityManager)
    {
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
        $this->squadReposetory = $entityManager->getRepository(Squad::class);
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
        $possitions = [
            "Brecher"=>"Brecher",
            "Jäger"=>"Jäger",
            "Sani"=>"Sanis",
            "Schütze"=>"Schützen",
            "Scout"=>"Scouts",
            "Stürmer"=>"Stürmer"
        ];

        $methaTyps = $this->squadReposetory->findAllMethaTyps();
        foreach ($methaTyps as $methaTyp){
            if (
                $methaTyp['methaTyp'] == "Fomori" ||
                $methaTyp['methaTyp'] == "Nartaki"||
                $methaTyp['methaTyp'] == "Hobgoblin"||
                $methaTyp['methaTyp'] == "Oger"||
                $methaTyp['methaTyp'] == "Oni"||
                $methaTyp['methaTyp'] == "Satyrn"||
                $methaTyp['methaTyp'] == "Gnom" ||
                $methaTyp['methaTyp'] == "Querx"||
                $methaTyp['methaTyp'] == "Nächtliche" ||
                $methaTyp['methaTyp'] == "Xapiri Thëpë" ||
                $methaTyp['methaTyp'] == "Wakyambi"||
                $methaTyp['methaTyp'] == "Minotaurus" ||
                $methaTyp['methaTyp'] == "Riese" ||
                $methaTyp['methaTyp'] == "Zyklop"
            ) {
                $otherMethaTypArray [$methaTyp['methaTyp']] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
            } else {
                if ($methaTyp['methaTyp'] == "Elf") {
                    $methaTypArray["Elfen"] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
                }
                if ($methaTyp['methaTyp'] == "Mensch") {
                    $methaTypArray["Menschen"] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
                }
                if ($methaTyp['methaTyp'] == "Ork") {
                    $methaTypArray["Orks"] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
                }
                if ($methaTyp['methaTyp'] == "Troll") {
                    $methaTypArray["Trolle"] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
                }
                if ($methaTyp['methaTyp'] == "Zwerg") {
                    $methaTypArray["Zwerge"] = $this->squadReposetory->findMostByMethaAndTeam($methaTyp['methaTyp']);
                }

            }

        }
        $topTenKills = $this->teamStatisticReposetory->findTopTenKills();
        $mostValuesByTeam = $this->squadReposetory->findMostValueByTeam();
        $newMostValuesByTeam = $this->getNewMostValuesByTeam($mostValuesByTeam);
        $newTopTenKills = $this->getNewTopTenKills($topTenKills);
        $averageAgeByTeam = $this->averageAgeByTeam();
        $totaleGoalesPerSeason = $this->totaleGoalesPerSeason();
        foreach ($possitions as $possition => $plural) {
            $newMostValuesByPossition[$possition] = $this->getNewMostValuesByPossition($possition,$plural);
            }
        return $this->render('page/statistics.html.twig', [
            'teams' => $this->teamReposetory->findAll(),
            'TopTenMethaTyp' => $methaTypArray,
            'TopTenOtherMethaTyp' => $otherMethaTypArray,
            'TopTenKills' => $newTopTenKills,
            'MostValuesByTeam' => $newMostValuesByTeam,
            'MostValuesByPossition' => $newMostValuesByPossition,
            'AverageAgeByTeam' => $averageAgeByTeam,
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

    public function averageAgeByTeam() {
        $teams = $this->teamReposetory->findAll();
        foreach ($teams as $team) {
            $averageAgeByTeam[$team->getName()] = [
                "team" => $this->teamReposetory->findOneBy(["id" => $this->squadReposetory->findAvrageAgeByTeam($team)["team_id"]]),
                "avrageAge" => $this->squadReposetory->findAvrageAgeByTeam($team)["avrageAge"],
            ];
        }
        return $averageAgeByTeam;
    }

    public function totaleGoalesPerSeason() {
        $teams = $this->teamReposetory->findAll();
        foreach ($teams as $team) {
            $averageAgeByTeam[$team->getName()] = [
                "team" => $this->teamReposetory->findOneBy(["id" => $this->squadReposetory->findAvrageAgeByTeam($team)["team_id"]]),
                "avrageAge" => $this->squadReposetory->findAvrageAgeByTeam($team)["avrageAge"],
            ];
        }
        return $averageAgeByTeam;
    }

    /**
     * @param $mostValuesByTeam
     * @return array
     */
    public function getNewMostValuesByTeam($mostValuesByTeam): array
    {
        foreach ($mostValuesByTeam as $mostValue) {
            $newMostValuesByTeam[] = [
                'team' => $this->teamReposetory->findOneBy(["id" => $mostValue['team_id']]),
                'value' => $mostValue['value']
            ];
        }
        return $newMostValuesByTeam;
    }

    /**
     * @param array $topTenKills
     * @return array
     */
    public function getNewTopTenKills(array $topTenKills): array
    {
        foreach ($topTenKills as $topTenKill) {
            $newTopTenKills[] = [
                'team' => $this->teamReposetory->findOneBy(["id" => $topTenKill['team_id']]),
                'kills' => $topTenKill['kills']
            ];
        }
        return $newTopTenKills;
    }

    /**
     * @return array
     */
    public function getNewMostValuesByPossition($position,$plural): array
    {
        $mostValuesByPossition = $this->squadReposetory->findMostValueByPossition($position);
        foreach ($mostValuesByPossition as $mostValue) {
            $newMostValuesByPossition[] = [
                'team' => $this->teamReposetory->findOneBy(["id" => $mostValue['team_id']]),
                'value' => $mostValue['value'],
                'position' => $plural,
                'name' => $mostValue['firstName'] .' "'. $mostValue['figthName'] .'" '. $mostValue['name'],
            ];
        }
        return $newMostValuesByPossition;
    }
}
