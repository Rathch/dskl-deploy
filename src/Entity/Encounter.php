<?php

namespace App\Entity;


use App\Repository\EncounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;


/**
 * @ORM\Entity(repositoryClass=EncounterRepository::class)
 */
class Encounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private  $chanceTeam1;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private  $chanceTeam2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private  $pointsTeam1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pointsTeam2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $report;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam1Leicht;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam1Schwer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam1Kritisch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam1Tot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam2Leicht;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam2Schwer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam2Kritisch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuryTeam2Tot;

    /**
     * @ORM\ManyToOne(targetEntity=PlayDay::class, inversedBy="encounters")
     */
    private $playDay;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="encounters")
     */
    private $team1;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="encounters")
     */
    private $team2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $winningTeam;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getChanceTeam1()
    {
        return $this->chanceTeam1;
    }

    /**
     * @param mixed $chanceTeam1
     */
    public function setChanceTeam1($chanceTeam1): void
    {
        $this->chanceTeam1 = $chanceTeam1;
    }

    /**
     * @return mixed
     */
    public function getChanceTeam2()
    {
        return $this->chanceTeam2;
    }

    /**
     * @param mixed $chanceTeam2
     */
    public function setChanceTeam2($chanceTeam2): void
    {
        $this->chanceTeam2 = $chanceTeam2;
    }



    /**
     * @return mixed
     */
    public function getPointsTeam1()
    {
        return $this->pointsTeam1;
    }

    /**
     * @param mixed $pointsTeam1
     */
    public function setPointsTeam1($pointsTeam1): void
    {
        $this->pointsTeam1 = $pointsTeam1;
    }

    /**
     * @return mixed
     */
    public function getPointsTeam2()
    {
        return $this->pointsTeam2;
    }

    /**
     * @param mixed $pointsTeam2
     */
    public function setPointsTeam2($pointsTeam2): void
    {
        $this->pointsTeam2 = $pointsTeam2;
    }



    /**
     * @return mixed
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param mixed $report
     */
    public function setReport($report): void
    {
        $this->report = $report;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam1Leicht()
    {
        return $this->injuryTeam1Leicht;
    }

    /**
     * @param mixed $injuryTeam1Leicht
     */
    public function setInjuryTeam1Leicht($injuryTeam1Leicht): void
    {
        $this->injuryTeam1Leicht = $injuryTeam1Leicht;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam1Schwer()
    {
        return $this->injuryTeam1Schwer;
    }

    /**
     * @param mixed $injuryTeam1Schwer
     */
    public function setInjuryTeam1Schwer($injuryTeam1Schwer): void
    {
        $this->injuryTeam1Schwer = $injuryTeam1Schwer;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam1Kritisch()
    {
        return $this->injuryTeam1Kritisch;
    }

    /**
     * @param mixed $injuryTeam1Kritisch
     */
    public function setInjuryTeam1Kritisch($injuryTeam1Kritisch): void
    {
        $this->injuryTeam1Kritisch = $injuryTeam1Kritisch;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam1Tot()
    {
        return $this->injuryTeam1Tot;
    }

    /**
     * @param mixed $injuryTeam1Tot
     */
    public function setInjuryTeam1Tot($injuryTeam1Tot): void
    {
        $this->injuryTeam1Tot = $injuryTeam1Tot;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam2Leicht()
    {
        return $this->injuryTeam2Leicht;
    }

    /**
     * @param mixed $injuryTeam2Leicht
     */
    public function setInjuryTeam2Leicht($injuryTeam2Leicht): void
    {
        $this->injuryTeam2Leicht = $injuryTeam2Leicht;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam2Schwer()
    {
        return $this->injuryTeam2Schwer;
    }

    /**
     * @param mixed $injuryTeam2Schwer
     */
    public function setInjuryTeam2Schwer($injuryTeam2Schwer): void
    {
        $this->injuryTeam2Schwer = $injuryTeam2Schwer;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam2Kritisch()
    {
        return $this->injuryTeam2Kritisch;
    }

    /**
     * @param mixed $injuryTeam2Kritisch
     */
    public function setInjuryTeam2Kritisch($injuryTeam2Kritisch): void
    {
        $this->injuryTeam2Kritisch = $injuryTeam2Kritisch;
    }

    /**
     * @return mixed
     */
    public function getInjuryTeam2Tot()
    {
        return $this->injuryTeam2Tot;
    }

    /**
     * @param mixed $injuryTeam2Tot
     */
    public function setInjuryTeam2Tot($injuryTeam2Tot): void
    {
        $this->injuryTeam2Tot = $injuryTeam2Tot;
    }

    public function getPlayDay(): ?PlayDay
    {
        return $this->playDay;
    }

    public function setPlayDay(?PlayDay $playDay): self
    {
        $this->playDay = $playDay;

        return $this;
    }

    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    public function setTeam1(?Team $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getWinningTeam(): ?int
    {
        return $this->winningTeam;
    }

    public function setWinningTeam(?int $winningTeam): self
    {
        $this->winningTeam = $winningTeam;

        return $this;
    }





}
