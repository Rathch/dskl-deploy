<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GenerateEncounterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;

final class PlayDayAdminController extends CRUDController{

    private $generateEncounterForPlayDayService;
    private $teamReposetory;

    /**
     * @param $generateEncounterForPlayDayService
     */
    public function __construct(GenerateEncounterService $generateEncounterForPlayDayService)
    {
        $this->generateEncounterForPlayDayService = $generateEncounterForPlayDayService;
    }


    protected function preCreate(Request $request, object $object): ?Response
    {
        return null;
    }
}
