<?php

namespace App\Entity;

use App\Repository\ChampionshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionshipRepository::class)]
class Championship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Tournament $tournament = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe1', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe1;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe2', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe2;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe3', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe3;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe4', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe4;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe5', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe5;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe6', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe6;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe7', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe7;

    #[ORM\OneToMany(mappedBy: 'championshipGroupe8', targetEntity: ChampionshipEncounter::class, cascade: ['persist', 'remove'])]
    private Collection $championshipEncounterGroupe8;

    #[ORM\ManyToOne(inversedBy: 'championship')]
    private ?Page $page = null;


    public function __construct()
    {
        $this->championshipEncounterGroupe1 = new ArrayCollection();
        $this->championshipEncounterGroupe2 = new ArrayCollection();
        $this->championshipEncounterGroupe3 = new ArrayCollection();
        $this->championshipEncounterGroupe4 = new ArrayCollection();
        $this->championshipEncounterGroupe5 = new ArrayCollection();
        $this->championshipEncounterGroupe6 = new ArrayCollection();
        $this->championshipEncounterGroupe7 = new ArrayCollection();
        $this->championshipEncounterGroupe8 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe1(): Collection
    {
        return $this->championshipEncounterGroupe1;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe2(): Collection
    {
        return $this->championshipEncounterGroupe2;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe3(): Collection
    {
        return $this->championshipEncounterGroupe3;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe4(): Collection
    {
        return $this->championshipEncounterGroupe4;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe5(): Collection
    {
        return $this->championshipEncounterGroupe5;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe6(): Collection
    {
        return $this->championshipEncounterGroupe6;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe7(): Collection
    {
        return $this->championshipEncounterGroupe7;
    }
    /**
     * @return Collection<int, ChampionshipEncounter>
     */
    public function getChampionshipEncounterGroupe8(): Collection
    {
        return $this->championshipEncounterGroupe8;
    }

    public function addChampionshipEncounterGroupe1(ChampionshipEncounter $championshipEncounterGroupe1): static
    {
        if (!$this->championshipEncounterGroupe1->contains($championshipEncounterGroupe1)) {
            $this->championshipEncounterGroupe1->add($championshipEncounterGroupe1);
            $championshipEncounterGroupe1->setChampionshipGroupe1($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe2(ChampionshipEncounter $championshipEncounterGroupe2): static
    {
        if (!$this->championshipEncounterGroupe2->contains($championshipEncounterGroupe2)) {
            $this->championshipEncounterGroupe2->add($championshipEncounterGroupe2);
            $championshipEncounterGroupe2->setChampionshipGroupe2($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe3(ChampionshipEncounter $championshipEncounterGroupe3): static
    {
        if (!$this->championshipEncounterGroupe3->contains($championshipEncounterGroupe3)) {
            $this->championshipEncounterGroupe3->add($championshipEncounterGroupe3);
            $championshipEncounterGroupe3->setChampionshipGroupe3($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe4(ChampionshipEncounter $championshipEncounterGroupe4): static
    {
        if (!$this->championshipEncounterGroupe4->contains($championshipEncounterGroupe4)) {
            $this->championshipEncounterGroupe4->add($championshipEncounterGroupe4);
            $championshipEncounterGroupe4->setChampionshipGroupe4($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe5(ChampionshipEncounter $championshipEncounterGroupe5): static
    {
        if (!$this->championshipEncounterGroupe5->contains($championshipEncounterGroupe5)) {
            $this->championshipEncounterGroupe5->add($championshipEncounterGroupe5);
            $championshipEncounterGroupe5->setChampionshipGroupe5($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe6(ChampionshipEncounter $championshipEncounterGroupe6): static
    {
        if (!$this->championshipEncounterGroupe6->contains($championshipEncounterGroupe6)) {
            $this->championshipEncounterGroupe6->add($championshipEncounterGroupe6);
            $championshipEncounterGroupe6->setChampionshipGroupe6($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe7(ChampionshipEncounter $championshipEncounterGroupe7): static
    {
        if (!$this->championshipEncounterGroupe7->contains($championshipEncounterGroupe7)) {
            $this->championshipEncounterGroupe7->add($championshipEncounterGroupe7);
            $championshipEncounterGroupe7->setChampionshipGroupe7($this);
        }

        return $this;
    }
    public function addChampionshipEncounterGroupe8(ChampionshipEncounter $championshipEncounterGroupe8): static
    {
        if (!$this->championshipEncounterGroupe8->contains($championshipEncounterGroupe8)) {
            $this->championshipEncounterGroupe8->add($championshipEncounterGroupe8);
            $championshipEncounterGroupe8->setChampionshipGroupe8($this);
        }

        return $this;
    }

    public function removeChampionshipEncounterGroupe1(ChampionshipEncounter $championshipEncounterGroupe1): static
    {
        if ($this->championshipEncounterGroupe1->removeElement($championshipEncounterGroupe1)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe1->getChampionshipGroupe1() === $this) {
                $championshipEncounterGroupe1->setChampionshipGroupe1(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe2(ChampionshipEncounter $championshipEncounterGroupe2): static
    {
        if ($this->championshipEncounterGroupe2->removeElement($championshipEncounterGroupe2)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe2->getChampionshipGroupe2() === $this) {
                $championshipEncounterGroupe2->setChampionshipGroupe2(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe3(ChampionshipEncounter $championshipEncounterGroupe3): static
    {
        if ($this->championshipEncounterGroupe3->removeElement($championshipEncounterGroupe3)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe3->getChampionshipGroupe3() === $this) {
                $championshipEncounterGroupe3->setChampionshipGroupe3(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe4(ChampionshipEncounter $championshipEncounterGroupe4): static
    {
        if ($this->championshipEncounterGroupe4->removeElement($championshipEncounterGroupe4)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe4->getChampionshipGroupe4() === $this) {
                $championshipEncounterGroupe4->setChampionshipGroupe4(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe5(ChampionshipEncounter $championshipEncounterGroupe5): static
    {
        if ($this->championshipEncounterGroupe5->removeElement($championshipEncounterGroupe5)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe5->getChampionshipGroupe5() === $this) {
                $championshipEncounterGroupe5->setChampionshipGroupe5(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe6(ChampionshipEncounter $championshipEncounterGroupe6): static
    {
        if ($this->championshipEncounterGroupe6->removeElement($championshipEncounterGroupe6)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe6->getChampionshipGroupe6() === $this) {
                $championshipEncounterGroupe6->setChampionshipGroupe6(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe7(ChampionshipEncounter $championshipEncounterGroupe7): static
    {
        if ($this->championshipEncounterGroupe7->removeElement($championshipEncounterGroupe7)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe7->getChampionshipGroupe7() === $this) {
                $championshipEncounterGroupe7->setChampionshipGroupe7(null);
            }
        }

        return $this;
    }
    public function removeChampionshipEncounterGroupe8(ChampionshipEncounter $championshipEncounterGroupe8): static
    {
        if ($this->championshipEncounterGroupe8->removeElement($championshipEncounterGroupe8)) {
            // set the owning side to null (unless already changed)
            if ($championshipEncounterGroupe8->getChampionshipGroupe8() === $this) {
                $championshipEncounterGroupe8->setChampionshipGroupe8(null);
            }
        }

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): static
    {
        $this->page = $page;

        return $this;
    }
}
