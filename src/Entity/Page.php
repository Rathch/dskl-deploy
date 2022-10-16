<?php

namespace App\Entity;

use App\Entity\ContentElements\Teaser;
use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $html = null;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: Teaser::class, cascade: ["persist"])]
    private Collection $contentElementsTeaser;

    public function __construct()
    {
        $this->contentElementsTeaser = new ArrayCollection();
    }

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

    public function setHtml($html): self
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return Collection<int, Teaser>
     */
    public function getContentElementsTeaser(): Collection
    {
        return $this->contentElementsTeaser;
    }

    public function addContentElementsTeaser(Teaser $contentElementsTeaser): self
    {
        if (!$this->contentElementsTeaser->contains($contentElementsTeaser)) {
            $this->contentElementsTeaser->add($contentElementsTeaser);
            $contentElementsTeaser->setPage($this);
        }

        return $this;
    }

    public function removeContentElementsTeaser(Teaser $contentElementsTeaser): self
    {
        if ($this->contentElementsTeaser->removeElement($contentElementsTeaser)) {
            // set the owning side to null (unless already changed)
            if ($contentElementsTeaser->getPage() === $this) {
                $contentElementsTeaser->setPage(null);
            }
        }

        return $this;
    }
}
