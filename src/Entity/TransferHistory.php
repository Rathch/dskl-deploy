<?php

namespace App\Entity;

use App\Repository\TransferHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransferHistoryRepository::class)]
class TransferHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'newTeam')]
    private ?Team $oldTeam = null;

    #[ORM\ManyToOne(inversedBy: 'transferHistories')]
    private ?Team $newTeam = null;

    #[ORM\ManyToOne(inversedBy: 'transferHistories')]
    private ?League $season = null;

    #[ORM\ManyToOne(inversedBy: 'transfers')]
    private ?Squad $squad = null;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldTeam(): ?Team
    {
        return $this->oldTeam;
    }

    public function setOldTeam(?Team $oldTeam): self
    {
        $this->oldTeam = $oldTeam;

        return $this;
    }

    public function getNewTeam(): ?Team
    {
        return $this->newTeam;
    }

    public function setNewTeam(?Team $newTeam): self
    {
        $this->newTeam = $newTeam;

        return $this;
    }

    public function getSeason(): ?League
    {
        return $this->season;
    }

    public function setSeason(?League $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getSquad(): ?Squad
    {
        return $this->squad;
    }

    public function setSquad(?Squad $squad): self
    {
        $this->squad = $squad;

        return $this;
    }

}
