<?php

namespace App\DataFixtures;


use App\Entity\Encounter;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        // create 24 teams! Bam!
        /*if (!$manager->getRepository(Team::class)->findAll()) {
            for ($i = 1; $i <= 24; $i++) {
                $team = new Team();
                $team->setName('Team '.$i." ".$faker->city);
                $team->setProfessionalism($faker->randomNumber(1));
                $team->setBrutality($faker->randomNumber(1));
                $team->setRobustness($faker->randomNumber(1));
                $team->setOffensive($faker->randomNumber(1));
                $team->setDefensive($faker->randomNumber(1));
                $team->setTactics($faker->randomNumber(1));
                $team->setSpirit($faker->randomNumber(1));
                $team->setActive(true);

                $manager->persist($team);
            }
        }*/


        $encounterReposetory = $manager->getRepository(Encounter::class);


        $encounters = $encounterReposetory->findAll();
        /** @var Encounter $encounter */
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
        }
        $manager->flush();
    }
}