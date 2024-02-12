<?php

namespace App\Entity;


use App\Repository\RelegationEncounterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: RelegationEncounterRepository::class)]
class RelegationEncounter extends AbstractEncounter
{
    #[ORM\ManyToOne(inversedBy: 'encounters2')]
    private ?Relegation $relegation2 = null;

    #[ORM\ManyToOne(inversedBy: 'encounters')]
    private ?Relegation $relegation = null;
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    public function getRelegation(): ?Relegation
    {
        return $this->relegation;
    }

    public function setRelegation(?Relegation $relegation): static
    {
        $this->relegation = $relegation;

        return $this;
    }

    public function getRelegation2(): ?Relegation
    {
        return $this->relegation2;
    }

    public function setRelegation2(?Relegation $relegation2): static
    {
        $this->relegation2 = $relegation2;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
