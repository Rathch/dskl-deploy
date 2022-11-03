<?php

namespace App\Entity;

use App\Repository\TeamAttributesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamAttributesRepository::class)]
class TeamAttributes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'teamAttributes',cascade: ['persist', 'remove'])]
    private ?Team $team = null;

    #[ORM\Column(type: 'integer')]
    private int $professionalism;

    #[ORM\Column(type: 'integer')]
    private int $brutality;

    #[ORM\Column(type: 'integer')]
    private int $robustness;

    #[ORM\Column(type: 'integer')]
    private int $offensive;

    #[ORM\Column(type: 'integer')]
    private int $defensive;

    #[ORM\Column(type: 'integer')]
    private int $tactics;

    #[ORM\Column(type: 'integer')]
    private int $spirit;

    private $power;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getProfessionalism(): int
    {
        return $this->professionalism;
    }

    public function setProfessionalism(int $professionalism): self
    {
        $this->professionalism = $professionalism;

        return $this;
    }

    public function getBrutality(): int
    {
        return $this->brutality;
    }

    public function setBrutality(int $brutality): self
    {
        $this->brutality = $brutality;

        return $this;
    }

    public function getRobustness(): int
    {
        return $this->robustness;
    }

    public function setRobustness(int $robustness): self
    {
        $this->robustness = $robustness;

        return $this;
    }

    public function getOffensive(): int
    {
        return $this->offensive;
    }

    public function setOffensive(int $offensive): void
    {
        $this->offensive = $offensive;
    }

    public function getDefensive(): int
    {
        return $this->defensive;
    }

    public function setDefensive(int $defensive): void
    {
        $this->defensive = $defensive;
    }

    /**
     * @return int
     */
    public function getTactics()
    {
        return $this->tactics;
    }

    public function setTactics(mixed $tactics): void
    {
        $this->tactics = $tactics;
    }

    /**
     * @return int
     */
    public function getSpirit()
    {
        return $this->spirit;
    }

    public function setSpirit(int $spirit): void
    {
        $this->spirit = $spirit;
    }

    public function getPower(): int
    {
        return $this->getBrutality() + $this->getProfessionalism() + $this->getProfessionalism() + $this->getRobustness() + $this->getDefensive() + $this->getOffensive() + $this->getSpirit() + $this->getTactics();
    }
}
