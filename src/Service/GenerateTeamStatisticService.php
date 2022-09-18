<?php

namespace App\Service;

use App\Entity\Encounter;
use App\Entity\League;
use App\Entity\LeagueStatistic;
use App\Entity\PlayDay;
use App\Entity\Team;
use App\Entity\TeamStatistic;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;

class GenerateTeamStatisticService
{
    protected $teamReposetory;
    protected $teamStatisticReposetory;
    protected $leagueStatisticReposetory;
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->teamReposetory = $entityManager->getRepository(Team::class);
        $this->teamStatisticReposetory = $entityManager->getRepository(TeamStatistic::class);
        $this->leagueStatisticReposetory = $entityManager->getRepository(LeagueStatistic::class);
    }

    public function generate(League $object)
    {

        $teams = $this->teamReposetory->findBy(["active" => true],null,$object->getNumberOfTeams());

        /** @var Team $team */
        foreach ($teams as $team) {
           $teamstatistic = new TeamStatistic();
           $teamstatistic->setLeague($object);
           $teamstatistic->setTeam($team);
           //$team->addTeamStatistic($teamstatistic);
           $teamstatistic->setDeaths(0);
           $teamstatistic->setGoaleDifference(0);
           $teamstatistic->setGoales(0);
           $teamstatistic->setInjuriesDoneLeich(0);
           $teamstatistic->setInjurysDoneKritisch(0);
           $teamstatistic->setInjurysDoneSchwer(0);
           $teamstatistic->setInjurysDoneTot(0);
           $teamstatistic->setInjuriesGetLeich(0);
           $teamstatistic->setInjurysGetKritisch(0);
           $teamstatistic->setInjurysGetSchwer(0);
           $teamstatistic->setInjurysGetTot(0);
           $teamstatistic->setDrows(0);
           $teamstatistic->setKills(0);
           $teamstatistic->setLoss(0);
           $teamstatistic->setOddsRatio(0);
           $teamstatistic->setOpportunities(0);
           $teamstatistic->setRang(0);
           $teamstatistic->setWins(0);
           $teamstatistic->setPreSeasson(0);
           $teamstatistic->setReGoeals(0);
           $teamstatistic->setPoints(0);

           $this->entityManager->persist($teamstatistic);
           //$this->entityManager->persist($team);
       }
        $this->entityManager->flush();
    }

    #[NoReturn] public function update(Encounter $encounter): void
    {
        $league = $encounter->getPlayDay()->getLeague();

        $teamStatistic1 = $this->teamStatisticReposetory->findBy([
            "team" => $encounter->getTeam1()
        ]);

        $teamStatistic2 = $this->teamStatisticReposetory->findBy([
            "team" => $encounter->getTeam2()
        ]);
        /** @var TeamStatistic $teamStatistic1 */
        $teamStatistic1 = $teamStatistic1[0];
        /** @var TeamStatistic $teamStatistic2 */
        $teamStatistic2 = $teamStatistic2[0];

        $this->checkWinningTeam($encounter);
        if ($this->checkWinningTeam($encounter) != $encounter->getWinningTeam())  {
            if ($encounter->getPointsTeam1() > $encounter->getPointsTeam2()) {
                $teamStatistic1->setWins($teamStatistic1->getWins()+1);
                $teamStatistic2->setWins($teamStatistic2->getWins()-1);
                $teamStatistic2->setLoss($teamStatistic2->getLoss()+1);
                $teamStatistic1->setLoss($teamStatistic1->getLoss()-1);
            } else {
                $teamStatistic2->setWins($teamStatistic2->getWins()+1);
                $teamStatistic1->setWins($teamStatistic1->getWins()-1);
                $teamStatistic1->setLoss($teamStatistic1->getLoss()+1);
                $teamStatistic2->setLoss($teamStatistic2->getLoss()-1);
            }
        }
        $this->entityManager->persist($teamStatistic1);
        $this->entityManager->persist($teamStatistic2);
        $this->entityManager->flush();

        //todo liga statistic
    }

    /**
     * @param Encounter $encounter
     * @return int
     */
    public function checkWinningTeam(Encounter $encounter)
    {
        if ($encounter->getPointsTeam1() > $encounter->getPointsTeam2()) {
            return $encounter->getTeam1()->getId();
        } else {
            return $encounter->getTeam2()->getId();
        }
    }

    public function show()
    {

        $teamStatistics = $this->teamStatisticReposetory->findAll();

        /** @var TeamStatistic $statistic */
        foreach ($teamStatistics as $statistic) {
            /** @var LeagueStatistic $leagueStatistic */
            $leagueStatistic = $this->leagueStatisticReposetory->findOneBy(["league" =>$statistic->getLeague()->getId()]);
            if (!$leagueStatistic->isDone()){
                $encounters = $statistic->getTeam()->getEncounters();
                /** @var Encounter $encounter */
                foreach ($encounters as $encounter) {
                    if ($encounter->getTeam1() === $statistic->getTeam()) {
                        if ( $encounter->getPointsTeam1() > $encounter->getPointsTeam2()) {
                            $statistic->setWins($statistic->getWins()+1);
                            $statistic->setPoints($statistic->getPoints()+3);
                        }
                        if ( $encounter->getPointsTeam1() < $encounter->getPointsTeam2()) {
                            $statistic->setLoss($statistic->getLoss()+1);
                        }
                        if ( $encounter->getPointsTeam1() === $encounter->getPointsTeam2()) {
                            $statistic->setDrows($statistic->getDrows()+1);
                            $statistic->setPoints($statistic->getPoints()+1);
                        }



                        $statistic->setGoales($statistic->getGoales()+$encounter->getPointsTeam1());
                        $statistic->setReGoeals($statistic->getReGoeals()+$encounter->getPointsTeam2());

                        //Chancenverhältnis = Die erste Zahl ist, wie viele Chancen sie hatten, die zweite wie viele sie zugelassen haben (also ihre Gegner hatten)
                        $statistic->setOpportunities( $statistic->getOpportunities()+$encounter->getChanceTeam1());
                        $statistic->setOpportunitiesOpponent( $statistic->getOpportunitiesOpponent()+$encounter->getChanceTeam2());

                        $statistic->setInjuriesGetLeich($statistic->getInjuriesGetLeich()+$encounter->getInjuryTeam1Leicht());
                        $statistic->setInjurysGetSchwer($statistic->getInjurysGetSchwer()+$encounter->getInjuryTeam1Schwer());
                        $statistic->setInjurysGetKritisch($statistic->getInjurysGetKritisch()+$encounter->getInjuryTeam1Kritisch());
                        $statistic->setDeaths($statistic->getDeaths()+$encounter->getInjuryTeam1Tot());

                        $statistic->setInjuriesDoneLeich($statistic->getInjuriesDoneLeich()+$encounter->getInjuryTeam2Leicht());
                        $statistic->setInjurysDoneSchwer($statistic->getInjurysDoneSchwer()+$encounter->getInjuryTeam2Schwer());
                        $statistic->setInjurysDoneKritisch($statistic->getInjurysDoneKritisch()+$encounter->getInjuryTeam2Kritisch());
                        $statistic->setKills($statistic->getDeaths()+$encounter->getInjuryTeam2Tot());

                    } else {
                        if ( $encounter->getPointsTeam1() < $encounter->getPointsTeam2()) {
                            $statistic->setWins($statistic->getWins()+1);
                            $statistic->setPoints($statistic->getPoints()+3);
                        }
                        if ( $encounter->getPointsTeam1() > $encounter->getPointsTeam2()) {
                            $statistic->setLoss($statistic->getLoss()+1);

                        }
                        if ( $encounter->getPointsTeam1() === $encounter->getPointsTeam2()) {
                            $statistic->setDrows($statistic->getDrows()+1);
                            $statistic->setPoints($statistic->getPoints()+1);
                        }

                        //$statistic->setPoints();

                        $statistic->setGoales($statistic->getGoales()+$encounter->getPointsTeam2());
                        $statistic->setReGoeals($statistic->getReGoeals()+$encounter->getPointsTeam1());



                        //Chancenverhältnis = Die erste Zahl ist, wie viele Chancen sie hatten, die zweite wie viele sie zugelassen haben (also ihre Gegner hatten)
                        $statistic->setOpportunities( $statistic->getOpportunities()+$encounter->getChanceTeam2());
                        $statistic->setOpportunitiesOpponent( $statistic->getOpportunitiesOpponent()+$encounter->getChanceTeam1());



                        $statistic->setInjuriesGetLeich($statistic->getInjuriesGetLeich()+$encounter->getInjuryTeam2Leicht());
                        $statistic->setInjurysGetSchwer($statistic->getInjurysGetSchwer()+$encounter->getInjuryTeam2Schwer());
                        $statistic->setInjurysGetKritisch($statistic->getInjurysGetKritisch()+$encounter->getInjuryTeam2Kritisch());
                        $statistic->setDeaths($statistic->getDeaths()+$encounter->getInjuryTeam2Tot());

                        $statistic->setInjuriesDoneLeich($statistic->getInjuriesDoneLeich()+$encounter->getInjuryTeam1Leicht());
                        $statistic->setInjurysDoneSchwer($statistic->getInjurysDoneSchwer()+$encounter->getInjuryTeam1Schwer());
                        $statistic->setInjurysDoneKritisch($statistic->getInjurysDoneKritisch()+$encounter->getInjuryTeam1Kritisch());
                        $statistic->setKills($statistic->getDeaths()+$encounter->getInjuryTeam1Tot());

                    }
                    if ($statistic->getOpportunities() > 0) {
                        //Chancenverwertung = (Tore) : (Chancen, also die erste Zahl)... ...die Chromlegion hat aus 151 Chancen 90 Tore gemacht, also waren 59,60% ihrer Chancen drin.
                        $statistic->setOddsRatio(intval(($statistic->getGoales()/$statistic->getOpportunities())*100));
                    }
                    //Tordifferenz ist richtig; = (Tore) - (Gegentore)
                    $statistic->setGoaleDifference($statistic->getGoales()-$statistic->getReGoeals());

                    $this->entityManager->persist($statistic);
                }
            }


        }
        $this->entityManager->flush();
        $teamStatisticsArray = [];
        $teamStatistics = $this->teamStatisticReposetory->findBy([], ['league' => 'ASC']);
        /** @var TeamStatistic $teamStatistic */
        foreach ($teamStatistics as $teamStatistic) {
            $teamStatisticsArray[$teamStatistic->getLeague()->getId()][] = $teamStatistic;
            /** @var LeagueStatistic $leagueStatistic */
            $leagueStatistic = $this->leagueStatisticReposetory->findOneBy(["league" =>$teamStatistic->getLeague()->getId()]);
            $leagueStatistic->setDone(true);
            $this->entityManager->persist($leagueStatistic);
        }
        $this->entityManager->flush();
        return $teamStatisticsArray;
    }

    /**
     * @throws \Exception
     */
    public function regenerate()
    {
        $leagueStatistics = $this->leagueStatisticReposetory->findAll()[0];

        if ($leagueStatistics->getTimestamp() < new \DateTime("yesterday")) {
            $teamStatistics = $this->teamStatisticReposetory->findAll();

            foreach ($teamStatistics as $statistic) {
                $statistic->setOddsRatio( 0);
                $statistic->setPoints( 0);
                $statistic->setWins( 0);
                $statistic->setDrows( 0);
                $statistic->setLoss( 0);
                $statistic->setReGoeals( 0);
                $statistic->setGoales( 0);
                $statistic->setGoaleDifference( 0);
                $statistic->setOpportunities( 0);
                $statistic->setOpportunities( 0);
                $statistic->setOpportunitiesOpponent( 0);

                $statistic->setInjuriesGetLeich(0);
                $statistic->setInjurysGetSchwer(0);
                $statistic->setInjurysGetKritisch(0);
                $statistic->setDeaths(0);

                $statistic->setInjuriesDoneLeich(0);
                $statistic->setInjurysDoneSchwer(0);
                $statistic->setInjurysDoneKritisch(0);
                $statistic->setKills(0);
                $this->entityManager->persist($statistic);
            }
            $leagueStatistics = $this->leagueStatisticReposetory->findAll();
            /** @var LeagueStatistic $leagueStatistic */
            foreach ($leagueStatistics as $leagueStatistic) {
                $leagueStatistic->setDone(false);
                $leagueStatistic->setTimestamp(new \datetime("now"));
                $this->entityManager->persist($leagueStatistic);
            }
            $this->entityManager->flush();
        }


    }
}