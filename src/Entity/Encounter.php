<?php

namespace App\Entity;


use App\Repository\EncounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;


#[ORM\Entity(repositoryClass: EncounterRepository::class)]
class Encounter extends AbstractEncounter
{
    #[ORM\ManyToOne(targetEntity: PlayDay::class, inversedBy: 'encounters')]
    private $playDay;

    #[ORM\ManyToOne(inversedBy: 'encounters')]
    private ?League $league = null;

    public function getPlayDay(): ?PlayDay
    {
        return $this->playDay;
    }

    public function setPlayDay(?PlayDay $playDay): self
    {
        $this->playDay = $playDay;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }
}
