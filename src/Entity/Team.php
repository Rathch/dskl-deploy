<?php

namespace App\Entity;

use App\Doctrine\Enum\Flag;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = "";


    #[ORM\OneToMany(mappedBy: 'team1', targetEntity: Encounter::class)]
    private $encounters;

    #[ORM\OneToMany(mappedBy: 'team2', targetEntity: Encounter::class)]
    private $encounters2;

    #[ORM\Column(type: "flag")]
    private ?Flag $active = null;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: TeamStatistic::class, cascade: ['persist', 'remove'])]
    private $teamStatistics;

    #[ORM\OneToOne(inversedBy: 'team', targetEntity: TeamInfo::class, cascade: ['persist', 'remove'])]
    private $teamInfo;

    #[ORM\OneToOne(inversedBy: 'team', targetEntity: TeamAttributes::class, cascade: ['persist', 'remove'])]
    private $teamAttributes;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Squad::class, cascade: ['persist', 'remove'])]
    #[ORM\OrderBy(['position' => 'DESC'])]
    private Collection $squads;

    #[ORM\OneToMany(mappedBy: 'oldTeam', targetEntity: TransferHistory::class)]
    private Collection $transferHistories;

    #[ORM\ManyToMany(targetEntity: League::class, mappedBy: 'activeTeams')]
    private Collection $activeInLeagues;

    #[ORM\OneToMany(mappedBy: 'teamOfTheDay', targetEntity: PlayDay::class)]
    private Collection $teamOfTheDays;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    private ?Affiliation $affiliation = null;

    public function __construct()
    {
        $this->encounters = new ArrayCollection();
        $this->encounters2 = new ArrayCollection();
        $this->teamStatistics = new ArrayCollection();
        $this->squads = new ArrayCollection();
        $this->transferHistories = new ArrayCollection();
        $this->activeInLeagues = new ArrayCollection();
        $this->teamOfTheDays = new ArrayCollection();
        $this->teamInfo = new TeamInfo();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }



    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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
            $this->encounters[] = $encounter;
            $encounter->setTeam1($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->removeElement($encounter)) {
            // set the owning side to null (unless already changed)
            if ($encounter->getTeam1() === $this) {
                $encounter->setTeam1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Encounter>
     */
    public function getEncounters2(): Collection
    {
        return $this->encounters2;
    }

    public function addEncounter2(Encounter $encounter2): self
    {
        if (!$this->encounters2->contains($encounter2)) {
            $this->encounters2[] = $encounter2;
            $encounter2->setTeam1($this);
        }

        return $this;
    }

    public function removeEncounter2(Encounter $encounter2): self
    {
        if ($this->encounters2->removeElement($encounter2)) {
            // set the owning side to null (unless already changed)
            if ($encounter2->getTeam1() === $this) {
                $encounter2->setTeam1(null);
            }
        }

        return $this;
    }

    public function getActive(): ?Flag
    {
        return $this->active;
    }

    public function setActive(?Flag $active): void
    {
        $this->active = $active;
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
            $teamStatistic->setTeam($this);
        }

        return $this;
    }

    public function removeTeamStatistic(TeamStatistic $teamStatistic): self
    {
        if ($this->teamStatistics->removeElement($teamStatistic)) {
            // set the owning side to null (unless already changed)
            if ($teamStatistic->getTeam() === $this) {
                $teamStatistic->setTeam(null);
            }
        }

        return $this;
    }

    public function getTeamInfo(): ?TeamInfo
    {
        return $this->teamInfo;
    }

    public function setTeamInfo(?TeamInfo $teamInfo): self
    {
        $this->teamInfo = $teamInfo;

        return $this;
    }

    public function getTeamAttributes(): ?TeamAttributes
    {
        return $this->teamAttributes;
    }

    public function setTeamAttributes(?TeamAttributes $teamAttributes): self
    {
        $this->teamAttributes = $teamAttributes;

        return $this;
    }

    /**
     * @return Collection<int, Squad>
     */
    public function getSquads(): Collection
    {
        return $this->squads;
    }

    public function addSquad(Squad $squad): self
    {
        if (!$this->squads->contains($squad)) {
            $this->squads[] =$squad;
            $squad->setTeam($this);
        }

        return $this;
    }

    public function removeSquad(Squad $squad): self
    {
        if ($this->squads->removeElement($squad)) {
            // set the owning side to null (unless already changed)
            if ($squad->getTeam() === $this) {
                $squad->setTeam(null);
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

    public function addTransferHistories(TransferHistory $transferHistories): self
    {
        if (!$this->transferHistories->contains($transferHistories)) {
            $this->transferHistories->add($transferHistories);
            $transferHistories->setOldTeam($this);
        }

        return $this;
    }

    public function removeTransferHistories(TransferHistory $transferHistories): self
    {
        if ($this->transferHistories->removeElement($transferHistories)) {
            // set the owning side to null (unless already changed)
            if ($transferHistories->getOldTeam() === $this) {
                $transferHistories->setOldTeam(null);
            }
        }

        return $this;
    }

    public function addTransferHistory(TransferHistory $transferHistory): self
    {
        if (!$this->transferHistories->contains($transferHistory)) {
            $this->transferHistories->add($transferHistory);
            $transferHistory->setNewTeam($this);
        }

        return $this;
    }

    public function removeTransferHistory(TransferHistory $transferHistory): self
    {
        if ($this->transferHistories->removeElement($transferHistory)) {
            // set the owning side to null (unless already changed)
            if ($transferHistory->getNewTeam() === $this) {
                $transferHistory->setNewTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, League>
     */
    public function getActiveInLeagues(): Collection
    {
        return $this->activeInLeagues;
    }

    public function addActiveInLeague(League $activeInLeague): self
    {
        if (!$this->activeInLeagues->contains($activeInLeague)) {
            $this->activeInLeagues->add($activeInLeague);
            $activeInLeague->addActiveTeam($this);
        }

        return $this;
    }

    public function removeActiveInLeague(League $activeInLeague): self
    {
        if ($this->activeInLeagues->removeElement($activeInLeague)) {
            $activeInLeague->removeActiveTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PlayDay>
     */
    public function getTeamOfTheDays(): Collection
    {
        return $this->teamOfTheDays;
    }

    public function addTeamOfTheDay(PlayDay $teamOfTheDay): self
    {
        if (!$this->teamOfTheDays->contains($teamOfTheDay)) {
            $this->teamOfTheDays->add($teamOfTheDay);
            $teamOfTheDay->setTeamOfTheDay($this);
        }

        return $this;
    }

    public function removeTeamOfTheDay(PlayDay $teamOfTheDay): self
    {
        if ($this->teamOfTheDays->removeElement($teamOfTheDay)) {
            // set the owning side to null (unless already changed)
            if ($teamOfTheDay->getTeamOfTheDay() === $this) {
                $teamOfTheDay->setTeamOfTheDay(null);
            }
        }

        return $this;
    }

    public function getAffiliation(): ?Affiliation
    {
        return $this->affiliation;
    }

    public function setAffiliation(?Affiliation $affiliation): static
    {
        $this->affiliation = $affiliation;

        return $this;
    }




}
