<?php

namespace App\Service;

use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\LeagueStatistic;
use App\Entity\PlayDay;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

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
        //todo: generate Team List

        $teams = $this->teamReposetory->findBy(["active" => true],null,1);
        $teams2 = $this->teamReposetory->findBy(["active" => true],null,$league->getNumberOfTeams());
        $matches = [];
        $counter = $league->getNumberOfTeams()-1;

        $this->make_schedule($league, $teams2,$league->getNumberOfPlayDays());
        $leagueStatistic = new LeagueStatistic();
        $leagueStatistic->setLeague($league);
        $leagueStatistic->setDone(false);
        $this->entityManager->persist($leagueStatistic);
        $this->entityManager->flush();
    }

    function make_schedule($league,array $teams, int $rounds = null, bool $shuffle = true, int $seed = null): array
    {
        $teamCount = count($teams);
        if($teamCount < 2) {
            return [];
        }
        //Account for odd number of teams by adding a bye
        if($teamCount % 2 === 1) {
            array_push($teams, null);
            $teamCount += 1;
        }
        if($shuffle) {
            //Seed shuffle with random_int for better randomness if seed is null
            srand($seed ?? random_int(PHP_INT_MIN, PHP_INT_MAX));
            shuffle($teams);
        } elseif(!is_null($seed)) {
            //Generate friendly notice that seed is set but shuffle is set to false
            trigger_error('Seed parameter has no effect when shuffle parameter is set to false');
        }
        $halfTeamCount = $teamCount / 2;
        if($rounds === null) {
            $rounds = $teamCount - 1;
        }
        $schedule = [];
        for($round = 1; $round <= $rounds; $round += 1) {
            $playDay = new PlayDay();
            $playDay->setLeague($league);
            foreach($teams as $key => $team) {
                if($key >= $halfTeamCount) {
                    break;
                }
                $team1 = $team;
                $team2 = $teams[$key + $halfTeamCount];
                $encounter = new Encounter();
                $encounter->setTeam1($team1);
                $encounter->setTeam2($team2);
                $encounter->setPlayDay($playDay);
                $playDay->addEncounter($encounter);
                $this->entityManager->persist($encounter);
                //Home-away swapping
                $matchup = $round % 2 === 0 ? [$team1, $team2] : [$team2, $team1];
                $schedule[$round][] = $matchup;

            }
            $this->entityManager->persist($playDay);
            $this->rotate($teams);
        }
        return $schedule;
    }


    function rotate(array &$items)
    {
        $itemCount = count($items);
        if($itemCount < 3) {
            return;
        }
        $lastIndex = $itemCount - 1;
        /**
         * Though not technically part of the round-robin algorithm, odd-even
         * factor differentiation included to have intuitive behavior for arrays
         * with an odd number of elements
         */
        $factor = (int) ($itemCount % 2 === 0 ? $itemCount / 2 : ($itemCount / 2) + 1);
        $topRightIndex = $factor - 1;
        $topRightItem = $items[$topRightIndex];
        $bottomLeftIndex = $factor;
        $bottomLeftItem = $items[$bottomLeftIndex];
        for($i = $topRightIndex; $i > 0; $i -= 1) {
            $items[$i] = $items[$i - 1];
        }
        for($i = $bottomLeftIndex; $i < $lastIndex; $i += 1) {
            $items[$i] = $items[$i + 1];
        }
        $items[1] = $bottomLeftItem;
        $items[$lastIndex] = $topRightItem;
    }
}