<?php

namespace App\Service;

use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\LeagueStatistic;
use App\Entity\PlayDay;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use ScheduleBuilder;

class GenerateEncounterService
{
    protected TeamRepository $teamReposetory;
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->teamReposetory = $entityManager->getRepository(Team::class);
    }

    public function generate(League $league)
    {
        //todo: get only active teams

        $teams = $this->teamReposetory->findBy([],null,1);
        $teams2 = $this->teamReposetory->findBy([],null,$league->getNumberOfTeams());
        $matches = [];
        $counter = $league->getNumberOfTeams()-1;
        $teams = ['The 1st', '2 Good', 'We 3', '4ward'];
        $scheduleBuilder = new ScheduleBuilder($teams2);
        $schedule = $scheduleBuilder->build();
        foreach ($schedule->full() as $round) {
            $this->mapRoundToPlayday($round, $league);
        }
        $leagueStatistic = new LeagueStatistic();
        $leagueStatistic->setLeague($league);
        $leagueStatistic->setDone(false);
        $this->entityManager->persist($leagueStatistic);
        $this->entityManager->flush();
    }


    private function mapRoundToPlayday(array $rounds, $league): void
    {
        $playDay = new PlayDay();
        $playDay->setLeague($league);
        foreach($rounds as $round) {
            $encounter = new Encounter();
            $encounter->setTeam1($round[0]);
            $encounter->setTeam2($round[1]);
            $encounter->setPlayDay($playDay);
            $playDay->addEncounter($encounter);
            $this->entityManager->persist($encounter);
        }
        $this->entityManager->persist($playDay);
    }
}