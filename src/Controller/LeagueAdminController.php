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

    public function __construct(private readonly GenerateTeamStatisticService $generateTeamStatisticService)
    {
    }



    /**
     * @throws Exception
     */
    public function generateStatisticAction(Request $request): Response
    {
        $league = $this->admin->getSubject();
        $this->generateTeamStatisticService->calculateStatistic($league);
        return new RedirectResponse('/admin/app/league/list');
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function regenerateStatisticAction(Request $request): Response
    {
        $league = $this->admin->getSubject();

        $this->generateTeamStatisticService->regenerateStatistic($league);
        return new RedirectResponse('/admin/app/league/list');
    }

}
