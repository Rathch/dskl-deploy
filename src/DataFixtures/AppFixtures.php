<?php

namespace App\DataFixtures;


use App\Doctrine\Enum\Flag;
use App\Doctrine\Enum\MethaTyp;
use App\Doctrine\Enum\Position;
use App\Entity\Encounter;
use App\Entity\Squad;
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
        $faker = \Faker\Factory::create("de_DE");
        // create 24 teams! Bam!
        if (!$manager->getRepository(Team::class)->findAll()) {
            for ($i = 1; $i <= 24; $i++) {
                $team = new Team();
                $team->setName('Team '.$i." ".$faker->city);
                $team->setActive(Flag::Active);
                $manager->persist($team);
            }
            $manager->flush();
            $teams = $manager->getRepository(Team::class)->findAll();
            foreach ($teams as $team) {
                $this->getTeamAttributesForTeam($faker, $team, $manager);
            }
            $manager->flush();
            foreach ($teams as $team) {
                $this->getTeamInfoForTeam($faker, $team, $manager);
            }
            foreach ($teams as $team) {
                $this->getSquadForTeam($faker, $team, $manager);
            }

        }



        $encounterReposetory = $manager->getRepository(Encounter::class);


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
            $encounter->setReport($faker->word);
        }
        $manager->flush();
    }

    /**
     * @param \Faker\Generator $faker
     * @param Team $team
     * @param ObjectManager $manager
     * @return TeamAttributes
     */
    protected function getTeamAttributesForTeam(\Faker\Generator $faker, Team $team, ObjectManager $manager): TeamAttributes
    {
        $teamAttributes = new TeamAttributes();
        $teamAttributes->setProfessionalism($faker->randomNumber(1));
        $teamAttributes->setBrutality($faker->randomNumber(1));
        $teamAttributes->setRobustness($faker->randomNumber(1));
        $teamAttributes->setOffensive($faker->randomNumber(1));
        $teamAttributes->setDefensive($faker->randomNumber(1));
        $teamAttributes->setTactics($faker->randomNumber(1));
        $teamAttributes->setSpirit($faker->randomNumber(1));
        $team->setTeamAttributes($teamAttributes);
        $teamAttributes->setTeam($team);
        $manager->persist($teamAttributes);
        return $teamAttributes;
    }

    /**
     * @param \Faker\Generator $faker
     * @param Team $team
     * @param ObjectManager $manager
     * @return void
     */
    protected function getTeamInfoForTeam(\Faker\Generator $faker, Team $team, ObjectManager $manager): void
    {
        $teamInfo = new TeamInfo();
        $teamInfo->setCity($faker->city);
        $teamInfo->setColor($faker->colorName);
        $teamInfo->setFoundingYear($faker->year);
        $teamInfo->setPresedent($faker->name);
        $teamInfo->setSponsor($faker->company);
        $teamInfo->setTrainer($faker->name);
        $teamInfo->setSuccesses($faker->sentence);
        $teamInfo->setTeam($team);
        $team->setTeamInfo($teamInfo);
        $manager->persist($teamInfo);
    }

    /**
     * @param \Faker\Generator $faker
     * @param Team $team
     * @param ObjectManager $manager
     * @return int
     */
    protected function getSquadForTeam(\Faker\Generator $faker, Team $team, ObjectManager $manager): int
    {
        $randomNumber = $faker->numberBetween(6,12);
        for ($i = 1; $i <= $randomNumber; $i++) {
            $methaTyp = $faker->randomElement([MethaTyp::elf, MethaTyp::mensch, MethaTyp::ork, MethaTyp::troll, MethaTyp::zwerg], $count = 1);
            $position = $faker->randomElement([Position::attaker, Position::breacher, Position::hunter, Position::sani, Position::scout, Position::shooter], $count = 1);
            $squad = new Squad();
            $squad->setTeam($team);
            $squad->setActive(Flag::Active);
            $squad->setName($faker->name);
            $squad->setAge($faker->numberBetween(18, 37));
            $squad->setMethaTyp($methaTyp);
            $squad->setPosition($position);
            $squad->setReplacement($faker->boolean());
            $squad->setValue($faker->randomNumber(6));
            $manager->persist($squad);
        }
        return $i;
    }
}