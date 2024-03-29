<?php

namespace App\Entity;

use App\Repository\PlayDayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayDayRepository::class)]
class PlayDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    #[ORM\OneToMany(targetEntity: Encounter::class, mappedBy: 'playDay')]
    private $encounters;

    #[ORM\ManyToOne(targetEntity: League::class, inversedBy: 'playdays')]
    private $league;

    #[ORM\ManyToOne(inversedBy: 'teamOfTheDays')]
    private ?Team $teamOfTheDay = null;

    #[ORM\ManyToMany(targetEntity: Squad::class, inversedBy: 'bestPlayersOfTheDay')]
    private Collection $bestPlayersOfTheDay;
    #[ORM\ManyToOne(inversedBy: 'playerOfTheDay')]
    private ?Squad $playerOfTheDay = null;

    public function __construct()
    {
        $this->encounters = new ArrayCollection();
        $this->bestPlayersOfTheDay = new ArrayCollection();
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
            $encounter->setPlayDay($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): self
    {
        if ($this->encounters->removeElement($encounter)) {
            // set the owning side to null (unless already changed)
            if ($encounter->getPlayDay() === $this) {
                $encounter->setPlayDay(null);
            }
        }

        return $this;
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

    public function getTeamOfTheDay(): ?Team
    {
        return $this->teamOfTheDay;
    }

    public function setTeamOfTheDay(?Team $teamOfTheDay): self
    {
        $this->teamOfTheDay = $teamOfTheDay;

        return $this;
    }

    public function getPlayerOfTheDay(): ?Squad
    {
        return $this->playerOfTheDay;
    }

    public function setPlayerOfTheDay(?Squad $playerOfTheDay): self
    {
        $this->playerOfTheDay = $playerOfTheDay;

        return $this;
    }

    /**
     * @return Collection<int, Squad>
     */
    public function getBestPlayersOfTheDay(): Collection
    {
        return $this->bestPlayersOfTheDay;
    }

    public function addBestPlayersOfTheDay(Squad $bestPlayersOfTheDay): self
    {
        if (!$this->bestPlayersOfTheDay->contains($bestPlayersOfTheDay)) {
            $this->bestPlayersOfTheDay->add($bestPlayersOfTheDay);
        }

        return $this;
    }

    public function removeBestPlayersOfTheDay(Squad $bestPlayersOfTheDay): self
    {
        $this->bestPlayersOfTheDay->removeElement($bestPlayersOfTheDay);

        return $this;
    }
}
