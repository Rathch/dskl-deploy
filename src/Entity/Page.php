<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slag = null;

    #[ORM\Column(type: "text")]
    private ?string $html = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $templatename = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlag(): ?string
    {
        return $this->slag;
    }

    public function setSlag(string $slag): self
    {
        $this->slag = $slag;

        return $this;
    }

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function setHtml(string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function getTemplatename(): ?string
    {
        return $this->templatename;
    }

    public function setTemplatename(?string $templatename): self
    {
        $this->templatename = $templatename;

        return $this;
    }
}
