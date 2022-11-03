<?php

namespace App\Entity;

use App\Doctrine\Enum\Flag;
use App\Doctrine\Enum\MethaTyp;
use App\Doctrine\Enum\Position;
use App\Doctrine\Type\MethaTypTyp;
use App\Repository\SquadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SquadRepository::class)]
class Squad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: "position")]
    private ?Position $position = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: "methaTyp")]
    private ?MethaTyp $methaTyp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $value = null;

    #[ORM\Column(type: "flag")]
    private ?Flag $active = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(targetEntity: Team::class,inversedBy: 'squads')]
    private ?Team $team = null;

    #[ORM\Column(nullable: true)]
    private ?bool $replacement = null;

    #[ORM\OneToMany(mappedBy: 'squad', targetEntity: TransferHistory::class)]
    private Collection $transfers;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $figthName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(nullable: true)]
    private ?int $birthYear = null;

    public function __construct()
    {
        $this->transfers = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMethaTyp(): ?MethaTyp
    {
        return $this->methaTyp;
    }

    public function setMethaTyp(?MethaTyp $methaTyp)
    {
        $this->methaTyp = $methaTyp;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): void
    {
        $this->position = $position;
    }

    public function getActive(): ?Flag
    {
        return $this->active;
    }

    public function setActive(?Flag $active): void
    {
        $this->active = $active;
    }





    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function isReplacement(): ?bool
    {
        return $this->replacement;
    }

    public function setReplacement(?bool $replacement): self
    {
        $this->replacement = $replacement;

        return $this;
    }

    /**
     * @return Collection<int, TransferHistory>
     */
    public function getTransfers(): Collection
    {
        return $this->transfers;
    }

    public function addTransfer(TransferHistory $transfer): self
    {
        if (!$this->transfers->contains($transfer)) {
            $this->transfers->add($transfer);
            $transfer->setSquad($this);
        }

        return $this;
    }

    public function removeTransfer(TransferHistory $transfer): self
    {
        if ($this->transfers->removeElement($transfer)) {
            // set the owning side to null (unless already changed)
            if ($transfer->getSquad() === $this) {
                $transfer->setSquad(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFigthName(): ?string
    {
        return $this->figthName;
    }

    public function setFigthName(?string $figthName): self
    {
        $this->figthName = $figthName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    public function setBirthYear(?int $birthYear): self
    {
        $this->birthYear = $birthYear;

        return $this;
    }




}
