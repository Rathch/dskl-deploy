<?php

namespace App\Entity;

use App\Repository\RelegationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelegationRepository::class)]
class Relegation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'relegation', cascade: ['persist', 'remove'])]
    private ?League $League = null;

    #[ORM\OneToMany(mappedBy: 'Relegation', targetEntity: Encounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounters;

    public function __construct()
    {
        $this->encounters = new ArrayCollection();
        $this->generateEncounter();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeague(): ?League
    {
        return $this->League;
    }

    public function setLeague(?League $league): static
    {
        $this->League = $league;

        return $this;
    }

    /**
     * @return Collection<int, Encounter>
     */
    public function getEncounters(): Collection
    {
        return $this->encounters;
    }

    public function addEncounter(Encounter $encounter): static
    {
        if (!$this->encounters->contains($encounter)) {
            $this->encounters->add($encounter);
            $encounter->setRelegation($this);
        }

        return $this;
    }

    public function removeEncounter(Encounter $encounter): static
    {
        if ($this->encounters->removeElement($encounter)) {
            // set the owning side to null (unless already changed)
            if ($encounter->getRelegation() === $this) {
                $encounter->setRelegation(null);
            }
        }

        return $this;
    }

    private function generateEncounter()
    {
        for ($x = 0; $x <= 24; $x++) {
            $this->addEncounter(new Encounter());
        }
    }
}
