<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nbRoues = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Voiture::class, orphanRemoval: true)]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbRoues(): ?int
    {
        return $this->nbRoues;
    }

    public function setNbRoues(int $nbRoues): self
    {
        $this->nbRoues = $nbRoues;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Voiture $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setType($this);
        }

        return $this;
    }

    public function removeType(Voiture $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getType() === $this) {
                $type->setType(null);
            }
        }

        return $this;
    }
}
