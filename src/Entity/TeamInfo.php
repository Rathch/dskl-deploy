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


    private  $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $color;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $foundingYear;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $sponsor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $president;

    private ?string $presedent;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $trainer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $successes;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $info;

    #[ORM\OneToOne(mappedBy: 'teamInfo', targetEntity: Team::class, cascade: ['persist', 'remove'])]
    private ?Team $team;

    #[ORM\OneToMany(mappedBy: 'teams', targetEntity: TeamStatistic::class)]
    private $teamStatistics;

    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'teamInfo', targetEntity: Retrospective::class, cascade: ['persist', 'remove'])]
    private Collection $retrospectives;

    public function __construct()
    {
        $this->teamStatistics = new ArrayCollection();
        $this->retrospectives = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string|null $info
     */
    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }


    public function getImageName(): ?string
    {
        return $this->imageName;
    }

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

    public function getpresident(): ?string
    {
        return $this->president;
    }

    public function setpresident(?string $president): self
    {
        $this->president = $president;

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

    public function getName(): ?string
    {
        return $this->getTeam()->getName();
    }

    /**
     * @return Collection<int, Retrospective>
     */
    public function getRetrospectives(): Collection
    {
        return $this->retrospectives;
    }

    public function addRetrospective(Retrospective $retrospective): self
    {
        if (!$this->retrospectives->contains($retrospective)) {
            $this->retrospectives->add($retrospective);
            $retrospective->setTeamInfo($this);
        }

        return $this;
    }

    public function removeRetrospective(Retrospective $retrospective): self
    {
        if ($this->retrospectives->removeElement($retrospective)) {
            // set the owning side to null (unless already changed)
            if ($retrospective->getTeamInfo() === $this) {
                $retrospective->setTeamInfo(null);
            }
        }

        return $this;
    }
}
