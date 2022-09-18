<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GenerateEncounterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;

final class LeagueAdminController extends CRUDController{
    private $generateEncounterService;
    private $teamReposetory;

    /**
     * @param $generateEncounterService
     */
    public function __construct(GenerateEncounterService $generateEncounterService)
    {
        $this->generateEncounterService = $generateEncounterService;
    }


    protected function preCreate(Request $request, object $object): ?Response
    {
        //$this->generateEncounterService->generate($object);
        return null;
    }
}
