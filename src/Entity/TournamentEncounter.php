<?php

namespace App\Entity;

use App\Repository\TournamentEncounterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentEncounterRepository::class)]
class TournamentEncounter extends AbstractEncounter
{
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound1')]
    private ?Tournament $tournamentRound1 = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound2')]
    private ?Tournament $tournamentRound2 = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound3')]
    private ?Tournament $tournamentRound3 = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound4')]
    private ?Tournament $tournamentRound4 = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound5')]
    private ?Tournament $tournamentRound5 = null;

    #[ORM\ManyToOne(inversedBy: 'encounterRound6')]
    private ?Tournament $tournamentRound6 = null;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTournamentRound1(): ?Tournament
    {
        return $this->tournamentRound1;
    }

    public function setTournamentRound1(?Tournament $tournamentRound1): static
    {
        $this->tournamentRound1 = $tournamentRound1;

        return $this;
    }

    public function getTournamentRound2(): ?Tournament
    {
        return $this->tournamentRound2;
    }

    public function setTournamentRound2(?Tournament $tournamentRound2): static
    {
        $this->tournamentRound2 = $tournamentRound2;

        return $this;
    }

    public function getTournamentRound3(): ?Tournament
    {
        return $this->tournamentRound3;
    }

    public function setTournamentRound3(?Tournament $tournamentRound3): static
    {
        $this->tournamentRound3 = $tournamentRound3;

        return $this;
    }

    public function getTournamentRound4(): ?Tournament
    {
        return $this->tournamentRound4;
    }

    public function setTournamentRound4(?Tournament $tournamentRound4): static
    {
        $this->tournamentRound4 = $tournamentRound4;

        return $this;
    }

    public function getTournamentRound5(): ?Tournament
    {
        return $this->tournamentRound5;
    }

    public function setTournamentRound5(?Tournament $tournamentRound5): static
    {
        $this->tournamentRound5 = $tournamentRound5;

        return $this;
    }

    public function getTournamentRound6(): ?Tournament
    {
        return $this->tournamentRound6;
    }

    public function setTournamentRound6(?Tournament $tournamentRound6): static
    {
        $this->tournamentRound6 = $tournamentRound6;

        return $this;
    }
}
