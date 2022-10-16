<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GenerateEncounterService;
use App\Service\GenerateTeamStatisticService;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;

final class LeagueAdminController extends CRUDController{

    private GenerateEncounterService $generateEncounterService;
    private GenerateTeamStatisticService $generateTeamStatisticService;


    /**
     * @param GenerateTeamStatisticService $generateTeamStatisticService
     * @param GenerateEncounterService $generateEncounterService
     */
    public function __construct(GenerateTeamStatisticService $generateTeamStatisticService, GenerateEncounterService $generateEncounterService)
    {

        $this->generateTeamStatisticService = $generateTeamStatisticService;
        $this->generateEncounterService = $generateEncounterService;

    }


    /**
     * @throws Exception
     */
    public function generateStatisticAction(Request $request): Response
    {
        $this->generateTeamStatisticService->show();
        return new RedirectResponse('/admin/app/league/list');
    }

    /**
     * @throws Exception
     */
    public function regenerateStatisticAction(Request $request): Response
    {
        $this->generateTeamStatisticService->regenerate();
        return new RedirectResponse('/admin/app/league/list');
    }

}
