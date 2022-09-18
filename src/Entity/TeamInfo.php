<?php

namespace App\Entity;

use App\Repository\TeamInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamInfoRepository::class)
 */
class TeamInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foundingYear;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sponsor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $presedent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trainer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $successes;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, cascade={"persist", "remove"})
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
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
        $this->team = $team;

        return $this;
    }
}
