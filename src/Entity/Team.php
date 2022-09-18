<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private readonly int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $professionalism;

    /**
     * @ORM\Column(type="integer")
     */
    private int $brutality;

    /**
     * @ORM\Column(type="integer")
     */
    private int $robustness;

    /**
     * @ORM\Column(type="integer")
     */
    private int $offensive;

    /**
     * @ORM\Column(type="integer")
     */
    private int $defensive;

    /**
     * @ORM\Column(type="integer")
     */
    private int $tactics;

    /**
     * @ORM\Column(type="integer")
     */
    private int $spirit;

    private $power;

    /**
     * @ORM\OneToMany(targetEntity=Encounter::class, mappedBy="team1")
     */
    private $encounters;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=TeamStatistic::class, mappedBy="teams")
     */
    private $teamStatistics;


    public function __construct()
    {
        $this->encounters = new ArrayCollection();
        $this->teamStatistics = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProfessionalism(): int
    {
        return $this->professionalism;
    }

    public function setProfessionalism(int $professionalism): self
    {
        $this->professionalism = $professionalism;

        return $this;
    }

    public function getBrutality(): int
    {
        return $this->brutality;
    }

    public function setBrutality(int $brutality): self
    {
        $this->brutality = $brutality;

        return $this;
    }

    public function getRobustness(): int
    {
        return $this->robustness;
    }

    public function setRobustness(int $robustness): self
    {
        $this->robustness = $robustness;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffensive(): int
    {
        return $this->offensive;
    }

    /**
     * @param int $offensive
     */
    public function setOffensive(int $offensive): void
    {
        $this->offensive = $offensive;
    }

    /**
     * @return int
     */
    public function getDefensive(): int
    {
        return $this->defensive;
    }

    /**
     * @param int $defensive
     */
    public function setDefensive(int $defensive): void
    {
        $this->defensive = $defensive;
    }

    /**
     * @return int
     */
    public function getTactics()
    {
        return $this->tactics;
    }

    /**
     * @param mixed $tactics
     */
    public function setTactics($tactics): void
    {
        $this->tactics = $tactics;
    }

    /**
     * @return int
     */
    public function getSpirit()
    {
        return $this->spirit;
    }

    /**
     * @param int $spirit
     */
    public function setSpirit(int $spirit): void
    {
        $this->spirit = $spirit;
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


    public function getPower(): int
    {
        return $this->getBrutality() + $this->getProfessionalism() + $this->getProfessionalism() + $this->getRobustness() + $this->getDefensive() + $this->getOffensive() + $this->getSpirit() + $this->getTactics();
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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
}