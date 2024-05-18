<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $teamAmount = null;

    #[ORM\OneToMany(mappedBy: 'tournamentRound1', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound1;

    #[ORM\OneToMany(mappedBy: 'tournamentRound2', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound2;

    #[ORM\OneToMany(mappedBy: 'tournamentRound3', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound3;

    #[ORM\OneToMany(mappedBy: 'tournamentRound4', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound4;

    #[ORM\OneToMany(mappedBy: 'tournamentRound5', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound5;

    #[ORM\OneToMany(mappedBy: 'tournamentRound6', targetEntity: TournamentEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $encounterRound6;

    public function __construct()
    {
        $this->encounterRound1 = new ArrayCollection();
        $this->encounterRound2 = new ArrayCollection();
        $this->encounterRound3 = new ArrayCollection();
        $this->encounterRound4 = new ArrayCollection();
        $this->encounterRound5 = new ArrayCollection();
        $this->encounterRound6 = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTeamAmount(): ?int
    {
        return $this->teamAmount;
    }

    public function setTeamAmount(int $teamAmount): static
    {
        $this->teamAmount = $teamAmount;

        return $this;
    }


    /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound1(): Collection
    {
        return $this->encounterRound1;
    }

   /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound2(): Collection
    {
        return $this->encounterRound2;
    }

    /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound3(): Collection
    {
        return $this->encounterRound3;
    }

    /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound4(): Collection
    {
        return $this->encounterRound4;
    }

    /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound5(): Collection
    {
        return $this->encounterRound5;
    }

    /**
     * @return Collection<int, TournamentEncounter>
     */
    public function getEncounterRound6(): Collection
    {
        return $this->encounterRound6;
    }

    public function addEncounterRound1(TournamentEncounter $encounterRound1): static
    {
        if (!$this->encounterRound1->contains($encounterRound1)) {
            $this->encounterRound1->add($encounterRound1);
            $encounterRound1->setTournamentRound1($this);
        }

        return $this;
    }

    public function addEncounterRound2(TournamentEncounter $encounterRound2): static
    {
        if (!$this->encounterRound2->contains($encounterRound2)) {
            $this->encounterRound2->add($encounterRound2);
            $encounterRound2->setTournamentRound2($this);
        }

        return $this;
    }
    
    public function addEncounterRound3(TournamentEncounter $encounterRound3): static
    {
        if (!$this->encounterRound3->contains($encounterRound3)) {
            $this->encounterRound3->add($encounterRound3);
            $encounterRound3->setTournamentRound3($this);
        }

        return $this;
    }
    
    public function addEncounterRound4(TournamentEncounter $encounterRound4): static
    {
        if (!$this->encounterRound4->contains($encounterRound4)) {
            $this->encounterRound4->add($encounterRound4);
            $encounterRound4->setTournamentRound4($this);
        }

        return $this;
    }
    
    public function addEncounterRound5(TournamentEncounter $encounterRound5): static
    {
        if (!$this->encounterRound5->contains($encounterRound5)) {
            $this->encounterRound5->add($encounterRound5);
            $encounterRound5->setTournamentRound5($this);
        }

        return $this;
    }
    
    public function addEncounterRound6(TournamentEncounter $encounterRound6): static
    {
        if (!$this->encounterRound6->contains($encounterRound6)) {
            $this->encounterRound6->add($encounterRound6);
            $encounterRound6->setTournamentRound6($this);
        }

        return $this;
    }




    public function removeEncounterRound1(TournamentEncounter $encounterRound1): static
    {
        if ($this->encounterRound1->removeElement($encounterRound1)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound1->getTournamentRound1() === $this) {
                $encounterRound1->setTournamentRound1(null);
            }
        }

        return $this;
    }

    public function removeEncounterRound2(TournamentEncounter $encounterRound2): static
    {
        if ($this->encounterRound2->removeElement($encounterRound2)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound2->getTournamentRound2() === $this) {
                $encounterRound2->setTournamentRound2(null);
            }
        }

        return $this;
    }

    public function removeEncounterRound3(TournamentEncounter $encounterRound3): static
    {
        if ($this->encounterRound3->removeElement($encounterRound3)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound3->getTournamentRound3() === $this) {
                $encounterRound3->setTournamentRound3(null);
            }
        }

        return $this;
    }

    public function removeEncounterRound4(TournamentEncounter $encounterRound4): static
    {
        if ($this->encounterRound4->removeElement($encounterRound4)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound4->getTournamentRound4() === $this) {
                $encounterRound4->setTournamentRound4(null);
            }
        }

        return $this;
    }

    public function removeEncounterRound5(TournamentEncounter $encounterRound5): static
    {
        if ($this->encounterRound5->removeElement($encounterRound5)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound5->getTournamentRound5() === $this) {
                $encounterRound5->setTournamentRound5(null);
            }
        }

        return $this;
    }

    public function removeEncounterRound6(TournamentEncounter $encounterRound6): static
    {
        if ($this->encounterRound6->removeElement($encounterRound6)) {
            // set the owning side to null (unless already changed)
            if ($encounterRound6->getTournamentRound6() === $this) {
                $encounterRound6->setTournamentRound6(null);
            }
        }

        return $this;
    }
}
