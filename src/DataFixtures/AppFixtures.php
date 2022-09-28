<?php

namespace App\DataFixtures;


use App\Entity\Encounter;
use App\Entity\Team;
use App\Entity\TeamAttributes;
use App\Entity\TeamInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    // doctrine:fixtures:load --append
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        // create 24 teams! Bam!
        if (!$manager->getRepository(Team::class)->findAll()) {
            for ($i = 1; $i <= 24; $i++) {
                $team = new Team();
                $team->setName('Team '.$i." ".$faker->city);
                $team->setActive(true);

                $teamAttributes = new TeamAttributes();
                $teamAttributes->setProfessionalism($faker->randomNumber(1));
                $teamAttributes->setBrutality($faker->randomNumber(1));
                $teamAttributes->setRobustness($faker->randomNumber(1));
                $teamAttributes->setOffensive($faker->randomNumber(1));
                $teamAttributes->setDefensive($faker->randomNumber(1));
                $teamAttributes->setTactics($faker->randomNumber(1));
                $teamAttributes->setSpirit($faker->randomNumber(1));


                $teamInfo = new TeamInfo();
                $teamInfo->setCity($faker->city);
                $teamInfo->setColor($faker->colorName);
                $teamInfo->setFoundingYear($faker->year);
                $teamInfo->setPresedent($faker->name);
                $teamInfo->setSponsor($faker->company);
                $teamInfo->setTrainer($faker->name);
                $teamInfo->setSuccesses($faker->sentence);


                $manager->persist($team);
                $manager->persist($teamAttributes);
                $manager->persist($teamInfo);
                $teamInfo->setTeam($team);
                $team->setTeamInfo($teamInfo);
                $teamAttributes->setTeam($team);
                $team->setTeamAttributes($teamAttributes);
                $manager->persist($team);
                $manager->persist($teamAttributes);
                $manager->persist($teamInfo);
            }
        }


        /*$encounterReposetory = $manager->getRepository(Encounter::class);


        $encounters = $encounterReposetory->findAll();

        foreach ($encounters as $encounter) {
            $encounter->setChanceTeam1($faker->numberBetween(1,10));
            $encounter->setChanceTeam2($faker->numberBetween(1,10));
            $encounter->setInjuryTeam1Leicht($faker->numberBetween(0,3));
            $encounter->setInjuryTeam2Leicht($faker->numberBetween(0,3));
            $encounter->setInjuryTeam1Kritisch($faker->numberBetween(0,3));
            $encounter->setInjuryTeam2Kritisch($faker->numberBetween(0,3));
            $encounter->setInjuryTeam1Schwer($faker->numberBetween(0,3));
            $encounter->setInjuryTeam2Schwer($faker->numberBetween(0,3));
            $encounter->setInjuryTeam1Tot($faker->numberBetween(0,3));
            $encounter->setInjuryTeam2Tot($faker->numberBetween(0,3));
            $encounter->setPointsTeam1($faker->numberBetween(1,10));
            $encounter->setPointsTeam2($faker->numberBetween(1,10));
            $encounter->setReport($faker->text);
        }*/
        $manager->flush();
    }
}