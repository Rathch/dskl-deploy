<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $seasonName;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: PlayDay::class)]
    private $playdays;

    #[ORM\Column(type: 'integer')]
    private int $numberOfTeams = 24;

    #[ORM\Column(type: 'integer')]
    private int $numberOfPlayDays = 23;



    #[ORM\ManyToOne(targetEntity: TeamStatistic::class, inversedBy: 'league')]
    #[ORM\OrderBy(['points' => 'DESC'])]
    private $teamStatistic;

    #[ORM\OneToOne(mappedBy: 'league', targetEntity: LeagueStatistic::class, cascade: ['persist', 'remove'])]
    private $leagueStatistic;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: TeamStatistic::class)]
    #[ORM\OrderBy(['points' => 'DESC'])]
    private $teamStatistics;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: TransferHistory::class)]
    private Collection $transferHistories;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: Encounter::class)]
    private Collection $encounters;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'activeInLeagues')]
    private Collection $activeTeams;

    public function __construct()
    {
        $this->playdays = new ArrayCollection();
        $this->teamStatistics = new ArrayCollection();
        $this->transferHistories = new ArrayCollection();
        $this->encounters = new ArrayCollection();
        $this->activeTeams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSeasonName()
    {
        return $this->seasonName;
    }

    public function setSeasonName(mixed $seasonName): void
    {
        $this->seasonName = $seasonName;
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

    /**
     * @return Collection<int, TransferHistory>
     */
    public function getTransferHistories(): Collection
    {
        return $this->transferHistories;
    }

    public function addTransferHistory(TransferHistory $transferHistory): self
    {
        if (!$this->transferHistories->contains($transferHistory)) {
            $this->transferHistories->add($transferHistory);
            $transferHistory->setSeason($this);
        }

        return $this;
    }

    public function removeTransferHistory(TransferHistory $transferHistory): self
    {
        if ($this->transferHistories->removeElement($transferHistory)) {
            // set the owning side to null (unless already changed)
            if ($transferHistory->getSeason() === $this) {
                $transferHistory->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Encounter>
     */
    public function getEncounters(): Collection
    {
        return $this->encounters;
    }

    public function addEncounter(Encounter $encounter): self
    {
        if (!$this->encounters->contains($encounter)) {
            $this->encounters->add($encounter);
            $encounter->setLeague($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->removeElement($encounter)) {
            // set the owning side to null (unless already changed)
            if ($encounter->getLeague() === $this) {
                $encounter->setLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getActiveTeams(): Collection
    {
        return $this->activeTeams;
    }

    public function addActiveTeam(Team $activeTeam): self
    {
        if (!$this->activeTeams->contains($activeTeam)) {
            $this->activeTeams->add($activeTeam);
        }

        return $this;
    }

    public function removeActiveTeam(Team $activeTeam): self
    {
        $this->activeTeams->removeElement($activeTeam);

        return $this;
    }
}
