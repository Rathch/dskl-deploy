<?php

namespace App\Entity;

use App\Repository\RetrospectiveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetrospectiveRepository::class)]
class Retrospective
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $report = null;

    #[ORM\ManyToOne(inversedBy: 'retrospectives')]
    private ?TeamInfo $teamInfo = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(?string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getTeamInfo(): ?TeamInfo
    {
        return $this->teamInfo;
    }

    public function setTeamInfo(?TeamInfo $teamInfo): self
    {
        $this->teamInfo = $teamInfo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
