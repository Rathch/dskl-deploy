<?php

namespace App\Entity;

use App\Repository\TeamStatisticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamStatisticRepository::class)
 */
class TeamStatistic
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
    private $points;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wins;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $drows;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $loss;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goaleDifference;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $goales;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reGoeals;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuriesDoneLeich;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysDoneSchwer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysDoneKritisch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysDoneTot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injuriesGetLeich;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysGetSchwer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysGetKritisch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $injurysGetTot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oddsRatio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kills;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $opportunities;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $opportunitiesOpponent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $preSeasson;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rang;

    /**
     * @ORM\ManyToOne(targetEntity=League::class, inversedBy="teamStatistics")
     */
    private $league;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="foo")
     */
    private $team;




    /**
     * @return mixed
     */
    public function getOpportunitiesOpponent()
    {
        return $this->opportunitiesOpponent;
    }

    /**
     * @param mixed $opportunitiesOpponent
     */
    public function setOpportunitiesOpponent($opportunitiesOpponent): void
    {
        $this->opportunitiesOpponent = $opportunitiesOpponent;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(?int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getDrows(): ?int
    {
        return $this->drows;
    }

    public function setDrows(?int $drows): self
    {
        $this->drows = $drows;

        return $this;
    }

    public function getLoss(): ?int
    {
        return $this->loss;
    }

    public function setLoss(?int $loss): self
    {
        $this->loss = $loss;

        return $this;
    }

    public function getGoaleDifference(): ?int
    {
        return $this->goaleDifference;
    }

    public function setGoaleDifference(?int $goaleDifference): self
    {
        $this->goaleDifference = $goaleDifference;

        return $this;
    }

    public function getGoales(): ?int
    {
        return $this->goales;
    }

    public function setGoales(?int $goales): self
    {
        $this->goales = $goales;

        return $this;
    }

    public function getReGoeals(): ?int
    {
        return $this->reGoeals;
    }

    public function setReGoeals(?int $reGoeals): self
    {
        $this->reGoeals = $reGoeals;

        return $this;
    }

    public function getInjuriesDoneLeich(): ?int
    {
        return $this->injuriesDoneLeich;
    }

    public function setInjuriesDoneLeich(?int $injuriesDoneLeich): self
    {
        $this->injuriesDoneLeich = $injuriesDoneLeich;

        return $this;
    }

    public function getInjurysDoneSchwer(): ?int
    {
        return $this->injurysDoneSchwer;
    }

    public function setInjurysDoneSchwer(?int $injurysDoneSchwer): self
    {
        $this->injurysDoneSchwer = $injurysDoneSchwer;

        return $this;
    }

    public function getInjurysDoneKritisch(): ?int
    {
        return $this->injurysDoneKritisch;
    }

    public function setInjurysDoneKritisch(?int $injurysDoneKritisch): self
    {
        $this->injurysDoneKritisch = $injurysDoneKritisch;

        return $this;
    }

    public function getOddsRatio(): ?int
    {
        return $this->oddsRatio;
    }

    public function setOddsRatio(?int $oddsRatio): self
    {
        $this->oddsRatio = $oddsRatio;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(?int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(?int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getOpportunities(): ?int
    {
        return $this->opportunities;
    }

    public function setOpportunities(?int $opportunities): self
    {
        $this->opportunities = $opportunities;

        return $this;
    }

    public function getPreSeasson(): ?string
    {
        return $this->preSeasson;
    }

    public function setPreSeasson(?string $preSeasson): self
    {
        $this->preSeasson = $preSeasson;

        return $this;
    }

    public function getRang(): ?string
    {
        return $this->rang;
    }

    public function setRang(?string $rang): self
    {
        $this->rang = $rang;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getInjurysDoneTot()
    {
        return $this->injurysDoneTot;
    }

    /**
     * @param mixed $injurysDoneTot
     */
    public function setInjurysDoneTot($injurysDoneTot): void
    {
        $this->injurysDoneTot = $injurysDoneTot;
    }

    /**
     * @return mixed
     */
    public function getInjuriesGetLeich()
    {
        return $this->injuriesGetLeich;
    }

    /**
     * @param mixed $injuriesGetLeich
     */
    public function setInjuriesGetLeich($injuriesGetLeich): void
    {
        $this->injuriesGetLeich = $injuriesGetLeich;
    }

    /**
     * @return mixed
     */
    public function getInjurysGetSchwer()
    {
        return $this->injurysGetSchwer;
    }

    /**
     * @param mixed $injurysGetSchwer
     */
    public function setInjurysGetSchwer($injurysGetSchwer): void
    {
        $this->injurysGetSchwer = $injurysGetSchwer;
    }

    /**
     * @return mixed
     */
    public function getInjurysGetKritisch()
    {
        return $this->injurysGetKritisch;
    }

    /**
     * @param mixed $injurysGetKritisch
     */
    public function setInjurysGetKritisch($injurysGetKritisch): void
    {
        $this->injurysGetKritisch = $injurysGetKritisch;
    }

    /**
     * @return mixed
     */
    public function getInjurysGetTot()
    {
        return $this->injurysGetTot;
    }

    /**
     * @param mixed $injurysGetTot
     */
    public function setInjurysGetTot($injurysGetTot): void
    {
        $this->injurysGetTot = $injurysGetTot;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }






}
