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


    #[ORM\OneToMany(mappedBy: 'team1', targetEntity: Encounter::class)]
    private $encounters;

    #[ORM\Column(type: "flag")]
    private ?Flag $active;

    #[ORM\OneToMany(mappedBy: 'teams', targetEntity: TeamStatistic::class, cascade: ['persist', 'remove'])]
    private $teamStatistics;

    #[ORM\OneToOne(inversedBy: 'team', targetEntity: TeamInfo::class, cascade: ['persist', 'remove'])]
    private $teamInfo;

    #[ORM\OneToOne(inversedBy: 'team', targetEntity: TeamAttributes::class, cascade: ['persist', 'remove'])]
    private $teamAttributes;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Squad::class, cascade: ['persist', 'remove'])]
    private Collection $squads;




    public function __construct()
    {
        $this->encounters = new ArrayCollection();
        $this->teamStatistics = new ArrayCollection();
        $this->squads = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
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
     * @return Flag|null
     */
    public function getActive(): ?Flag
    {
        return $this->active;
    }

    /**
     * @param Flag|null $active
     */
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


}