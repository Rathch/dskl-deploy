<?php

namespace App\Entity;


use App\Repository\ChampionshipEncounterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ChampionshipEncounterRepository::class)]
class ChampionshipEncounter extends AbstractEncounter
{
    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe1')]
    private ?Championship $championshipGroupe1 = null;

    public function getChampionshipGroupe1(): ?Championship
    {
        return $this->championshipGroupe1;
    }

    public function setChampionshipGroupe1(?Championship $championshipGroupe1): static
    {
        $this->championshipGroupe1 = $championshipGroupe1;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe2')]
    private ?Championship $championshipGroupe2 = null;

    public function getChampionshipGroupe2(): ?Championship
    {
        return $this->championshipGroupe2;
    }

    public function setChampionshipGroupe2(?Championship $championshipGroupe2): static
    {
        $this->championshipGroupe2 = $championshipGroupe2;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe3')]
    private ?Championship $championshipGroupe3 = null;

    public function getChampionshipGroupe3(): ?Championship
    {
        return $this->championshipGroupe3;
    }

    public function setChampionshipGroupe3(?Championship $championshipGroupe3): static
    {
        $this->championshipGroupe3 = $championshipGroupe3;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe4')]
    private ?Championship $championshipGroupe4 = null;

    public function getChampionshipGroupe4(): ?Championship
    {
        return $this->championshipGroupe4;
    }

    public function setChampionshipGroupe4(?Championship $championshipGroupe4): static
    {
        $this->championshipGroupe4 = $championshipGroupe4;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe5')]
    private ?Championship $championshipGroupe5 = null;

    public function getChampionshipGroupe5(): ?Championship
    {
        return $this->championshipGroupe5;
    }

    public function setChampionshipGroupe5(?Championship $championshipGroupe5): static
    {
        $this->championshipGroupe5 = $championshipGroupe5;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe6')]
    private ?Championship $championshipGroupe6 = null;

    public function getChampionshipGroupe6(): ?Championship
    {
        return $this->championshipGroupe6;
    }

    public function setChampionshipGroupe6(?Championship $championshipGroupe6): static
    {
        $this->championshipGroupe6 = $championshipGroupe6;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe7')]
    private ?Championship $championshipGroupe7 = null;

    public function getChampionshipGroupe7(): ?Championship
    {
        return $this->championshipGroupe7;
    }

    public function setChampionshipGroupe7(?Championship $championshipGroupe7): static
    {
        $this->championshipGroupe7 = $championshipGroupe7;

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'chempionshipEncounterGroupe8')]
    private ?Championship $championshipGroupe8 = null;

    public function getChampionshipGroupe8(): ?Championship
    {
        return $this->championshipGroupe8;
    }

    public function setChampionshipGroupe8(?Championship $championshipGroupe8): static
    {
        $this->championshipGroupe8 = $championshipGroupe8;

        return $this;
    }
}
