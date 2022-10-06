<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Team;
use App\Repository\PageRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    protected EntityManagerInterface $entityManager;
    protected PageRepository $pageReposetory;
    protected TeamRepository $teamReposetory;


    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pageReposetory = $entityManager->getRepository(Page::class);
        $this->teamReposetory = $entityManager->getRepository(Team::class);
    }



    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
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
        return $this->render('page/team.show.html.twig', [
            'controller_name' => 'PageController',
            'team' => $team,
        ]);
    }
}
