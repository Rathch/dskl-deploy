<?php

namespace App\Entity;

use App\Doctrine\Enum\Flag;
use App\Doctrine\Enum\Position;
use App\Repository\SquadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SquadRepository::class)]
class Squad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: "position")]
    private ?Position $position = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metatyp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $value = null;

    #[ORM\Column(type: "flag")]
    private ?Flag $active = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(targetEntity: Team::class,inversedBy: 'squads')]
    private ?Team $team = null;

    #[ORM\Column(nullable: true)]
    private ?bool $replacement = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMetatyp(): ?string
    {
        return $this->metatyp;
    }

    public function setMetatyp(?string $metatyp): self
    {
        $this->metatyp = $metatyp;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Position|null
     */
    public function getPosition(): ?Position
    {
        return $this->position;
    }

    /**
     * @param Position|null $position
     */
    public function setPosition(?Position $position): void
    {
        $this->position = $position;
    }

    /**
     * @return Flag|null
     */
    public function getActive(): ?Flag
    {
        return $this->active;
    }

    /**
     * @param Flag|null $active
     */
    public function setActive(?Flag $active): void
    {
        $this->active = $active;
    }





    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

    public function isReplacement(): ?bool
    {
        return $this->replacement;
    }

    public function setReplacement(?bool $replacement): self
    {
        $this->replacement = $replacement;

        return $this;
    }


}
