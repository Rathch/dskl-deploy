<?php

namespace App\Entity;

use App\Repository\TeamInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: TeamInfoRepository::class)]
class TeamInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    private UploadedFile $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $color;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $foundingYear;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sponsor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $presedent;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $trainer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $successes;

    #[ORM\OneToOne(targetEntity: Team::class, mappedBy: 'teamInfo', cascade: ['persist', 'remove'])]
    private $team;

    #[ORM\OneToMany(targetEntity: TeamStatistic::class, mappedBy: 'teams')]
    private $teamStatistics;

    public function __construct()
    {
        $this->teamStatistics = new ArrayCollection();
    }


    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function setImage(?UploadedFile $uploadedFile): void
    {
        $this->image = $uploadedFile;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getFoundingYear(): ?string
    {
        return $this->foundingYear;
    }

    public function setFoundingYear(?string $foundingYear): self
    {
        $this->foundingYear = $foundingYear;

        return $this;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function setSponsor(?string $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getPresedent(): ?string
    {
        return $this->presedent;
    }

    public function setPresedent(?string $presedent): self
    {
        $this->presedent = $presedent;

        return $this;
    }

    public function getTrainer(): ?string
    {
        return $this->trainer;
    }

    public function setTrainer(?string $trainer): self
    {
        $this->trainer = $trainer;

        return $this;
    }

    public function getSuccesses(): ?string
    {
        return $this->successes;
    }

    public function setSuccesses(?string $successes): self
    {
        $this->successes = $successes;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        // unset the owning side of the relation if necessary
        if ($team === null && $this->team !== null) {
            $this->team->setTeamInfo(null);
        }

        // set the owning side of the relation if necessary
        if ($team !== null && $team->getTeamInfo() !== $this) {
            $team->setTeamInfo($this);
        }

        $this->team = $team;

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
            $teamStatistic->setTeamInfo($this);
        }

        return $this;
    }

    public function removeTeamStatistic(TeamStatistic $teamStatistic): self
    {
        if ($this->teamStatistics->removeElement($teamStatistic)) {
            // set the owning side to null (unless already changed)
            if ($teamStatistic->getTeamInfo() === $this) {
                $teamStatistic->setTeamInfo(null);
            }
        }

        return $this;
    }

}
