<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\GenerateEncounterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;

final class PlayDayAdminController extends CRUDController{

    private $teamReposetory;

    /**
     * @param $generateEncounterForPlayDayService
     */
    public function __construct(private readonly GenerateEncounterService $generateEncounterForPlayDayService)
    {
    }


    protected function preCreate(Request $request, object $object): ?Response
    {
        return null;
    }
}
