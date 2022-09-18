<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeagueRepository::class)
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=PlayDay::class, mappedBy="league")
     */
    private $playdays;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfTeams;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPlayDays;

    /**
     * @ORM\ManyToOne(targetEntity=TeamStatistic::class, inversedBy="league")
     */
    private $teamStatistic;

    /**
     * @ORM\OneToOne(targetEntity=LeagueStatistic::class, mappedBy="league", cascade={"persist", "remove"})
     */
    private $leagueStatistic;

    /**
     * @ORM\OneToMany(targetEntity=TeamStatistic::class, mappedBy="league2")
     */
    private $teamStatistics;

    public function __construct()
    {
        $this->numberOfPlayDays = 23;
        $this->numberOfTeams = 24;
        $this->playdays = new ArrayCollection();
        $this->teamStatistics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, PlayDay>
     */
    public function getPlaydays(): Collection
    {
        return $this->playdays;
    }

    public function addPlayday(PlayDay $playday): self
    {
        if (!$this->playdays->contains($playday)) {
            $this->playdays[] = $playday;
            $playday->setLeague($this);
        }

        return $this;
    }

    public function removePlayday(PlayDay $playday): self
    {
        if ($this->playdays->removeElement($playday)) {
            // set the owning side to null (unless already changed)
            if ($playday->getLeague() === $this) {
                $playday->setLeague(null);
            }
        }

        return $this;
    }

    public function getNumberOfTeams(): ?int
    {
        return $this->numberOfTeams;
    }

    public function setNumberOfTeams(int $numberOfTeams): self
    {
        $this->numberOfTeams = $numberOfTeams;

        return $this;
    }

    public function getNumberOfPlayDays(): ?int
    {
        return $this->numberOfPlayDays;
    }

    public function setNumberOfPlayDays(int $numberOfPlayDays): self
    {
        $this->numberOfPlayDays = $numberOfPlayDays;

        return $this;
    }

    public function getTeamStatistic(): ?TeamStatistic
    {
        return $this->teamStatistic;
    }

    public function setTeamStatistic(?TeamStatistic $teamStatistic): self
    {
        $this->teamStatistic = $teamStatistic;

        return $this;
    }

    public function getLeagueStatistic(): ?LeagueStatistic
    {
        return $this->leagueStatistic;
    }

    public function setLeagueStatistic(?LeagueStatistic $leagueStatistic): self
    {
        // unset the owning side of the relation if necessary
        if ($leagueStatistic === null && $this->leagueStatistic !== null) {
            $this->leagueStatistic->setLeague(null);
        }

        // set the owning side of the relation if necessary
        if ($leagueStatistic !== null && $leagueStatistic->getLeague() !== $this) {
            $leagueStatistic->setLeague($this);
        }

        $this->leagueStatistic = $leagueStatistic;

        return $this;
    }

    /**
     * @return Collection<int, TeamStatistic>
     */
    public function getTeamStatistics(): Collection
    {
        return $this->teamStatistics;
    }

    public function addTeamStatistic(TeamStatistic $teamStatistic): self
    {
        if (!$this->teamStatistics->contains($teamStatistic)) {
            $this->teamStatistics[] = $teamStatistic;
            $teamStatistic->setLeague($this);
        }

        return $this;
    }

    public function removeTeamStatistic(TeamStatistic $teamStatistic): self
    {
        if ($this->teamStatistics->removeElement($teamStatistic)) {
            // set the owning side to null (unless already changed)
            if ($teamStatistic->getLeague() === $this) {
                $teamStatistic->setLeague(null);
            }
        }

        return $this;
    }
}
