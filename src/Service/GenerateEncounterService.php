<?php

namespace App\Service;

use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\LeagueStatistic;
use App\Entity\PlayDay;
use App\Entity\Team;
use App\Repository\EncounterRepository;
use App\Repository\PlayDayRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use ScheduleBuilder;

class GenerateEncounterService
{
    protected TeamRepository $teamRepository;
    protected EncounterRepository $encounterRepository;
    protected PlayDayRepository $playDayRepository;

    public function __construct(protected EntityManagerInterface $entityManager)
    {
        $this->teamRepository = $entityManager->getRepository(Team::class);
        $this->encounterRepository = $entityManager->getRepository(Encounter::class);
        $this->playDayRepository = $entityManager->getRepository(PlayDay::class);
    }

    public function generate(League $league)
    {


        $scheduleBuilder = new ScheduleBuilder($league->getActiveTeams()->toArray());
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


    private function mapRoundToPlayday(array $rounds, League $league): void
    {
        $playDay = new PlayDay();
        $playDay->setLeague($league);
        foreach($rounds as $round) {
            $encounter = new Encounter();
            $encounter->setTeam1($round[0]);
            $encounter->setTeam2($round[1]);
            $encounter->setPlayDay($playDay);
            $encounter->setLeague($league);
            $playDay->addEncounter($encounter);
            $this->entityManager->persist($encounter);
            $league->addEncounter($encounter);
            $this->entityManager->persist($league);
        }
        $this->entityManager->persist($playDay);
    }

    public function removeByLeauge($object)
    {
        /** @var League $league */
        $league = $object;
        $encounters = $league->getEncounters();
        foreach ($encounters as $encounter) {
            $this->encounterRepository->remove($encounter);
        }
        $playDays = $league->getPlaydays();
        foreach ($playDays as $playDay) {
            $this->playDayRepository->remove($playDay);
        }
        $this->entityManager->flush();
    }
}