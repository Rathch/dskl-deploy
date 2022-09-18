<?php

namespace App\Controller;

use App\Service\GenerateEncounterService;
use App\Service\GenerateTeamStatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamStatisticsController extends AbstractController
{

    private GenerateTeamStatisticService $generateTeamStatisticService;


    /**
     * @param $generateTeamStatisticService
     */
    public function __construct(GenerateTeamStatisticService $generateTeamStatisticService)
    {

        $this->generateTeamStatisticService = $generateTeamStatisticService;

    }

    #[Route(path: '/teamstatistic', name: 'team.statistic')]
    public function teamStatisticAction(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render("statistics/teamstatistics.html.twig",["teamstatistics"=>$this->generateTeamStatisticService->show()]);
    }

    #[Route(path: '/teamstatistic/regenerate', name: 'team.statistic.regenerate')]
    public function teamStatisticRegenerateAction(Request $request)
    {
        $this->generateTeamStatisticService->regenerate();
        return new RedirectResponse('/teamstatistic');
    }
}