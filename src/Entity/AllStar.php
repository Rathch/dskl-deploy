<?php

namespace App\Entity;

use App\Repository\AllStarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllStarRepository::class)]
class AllStar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?League $league = null;

    #[ORM\ManyToMany(targetEntity: Squad::class, inversedBy: 'allStars')]
    private Collection $allStarsMambers;

    public function __construct()
    {
        $this->allStarsMambers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Squad>
     */
    public function getAllStarsMambers(): Collection
    {
        return $this->allStarsMambers;
    }

    public function addAllStarsMamber(Squad $allStarsMamber): self
    {
        if (!$this->allStarsMambers->contains($allStarsMamber)) {
            $this->allStarsMambers->add($allStarsMamber);
        }

        return $this;
    }

    public function removeAllStarsMamber(Squad $allStarsMamber): self
    {
        $this->allStarsMambers->removeElement($allStarsMamber);

        return $this;
    }
}
