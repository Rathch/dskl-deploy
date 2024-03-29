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

    #[ORM\Column(nullable: true)]
    private ?int $value = null;


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

    #[ORM\Column(nullable: true)]
    private $active = null;


    private ?string $fullname = null;
    private ?string $fullInfos = null;

    #[ORM\OneToMany(mappedBy: 'playerOfTheDay', targetEntity: PlayDay::class)]
    private Collection $playerOfTheDay;

    #[ORM\Column(nullable: true)]
    private ?bool $dead = null;

    #[ORM\ManyToMany(targetEntity: League::class, mappedBy: 'bestPlayersOfTheDay')]
    private Collection $bestPlayersOfTheDay;

    #[ORM\ManyToMany(targetEntity: AllStar::class, mappedBy: 'allStarsMambers')]
    private Collection $allStars;

    public function __construct()
    {
        $this->transfers = new ArrayCollection();
        $this->playerOfTheDay = new ArrayCollection();
        $this->bestPlayersOfTheDay = new ArrayCollection();
        $this->allStars = new ArrayCollection();
    }

    /**
     * @return Collection<int, PlayDay>
     */
    public function getPlayerOfTheDay(): Collection
    {
        return $this->playerOfTheDay;
    }

    public function addPlayerOfTheDay(PlayDay $playerOfTheDay): self
    {
        if (!$this->playerOfTheDay->contains($playerOfTheDay)) {
            $this->playerOfTheDay->add($playerOfTheDay);
            $playerOfTheDay->setPlayerOfTheDay($this);
        }

        return $this;
    }

    public function removePlayerOfTheDay(PlayDay $playerOfTheDay): self
    {
        if ($this->playerOfTheDay->removeElement($playerOfTheDay)) {
            // set the owning side to null (unless already changed)
            if ($playerOfTheDay->getPlayerOfTheDay() === $this) {
                $playerOfTheDay->setPlayerOfTheDay(null);
            }
        }

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): void
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

    /**
     * @return string|null
     */
    public function getFullname(): ?string
    {
        return $this->getFirstName()." '". $this->getFigthName()."' ". $this->getName();
    }

    /**
     * @return string|null
     */
    public function getFullInfo(): ?string
    {
        return $this->getFirstName()." '". $this->getFigthName()."' ". $this->getName()." - ". $this->getTeam()->getName() ." - ". $this->getPosition()->value;
    }

    public function isDead(): ?bool
    {
        return $this->dead;
    }

    public function setDead(?bool $dead): self
    {
        $this->dead = $dead;

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

    /**
     * @return Collection<int, AllStar>
     */
    public function getAllStars(): Collection
    {
        return $this->allStars;
    }

    public function addAllStar(AllStar $allStar): self
    {
        if (!$this->allStars->contains($allStar)) {
            $this->allStars->add($allStar);
            $allStar->addAllStarsMamber($this);
        }

        return $this;
    }

    public function removeAllStar(AllStar $allStar): self
    {
        if ($this->allStars->removeElement($allStar)) {
            $allStar->removeAllStarsMamber($this);
        }

        return $this;
    }
}
