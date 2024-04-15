<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['plat:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['plat:read'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['plat:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['plat:read'])]
    private ?float $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['plat:read'])]
    private ?string $photo = null;

    #[ORM\Column]
    #[Groups(['plat:read'])]
    private ?bool $clickncollect = null;

    #[ORM\Column]
    #[Groups(['plat:read'])]
    private ?bool $platDuJour = null;

    #[ORM\Column]
    #[Groups(['plat:read'])]
    private ?bool $specialite = null;

    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['plat:read'])]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'plats')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['plat:read'])]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToMany(targetEntity: Allergene::class, inversedBy: 'plats')]
    #[Groups(['plat:read'])]
    private Collection $allergene;

    public function __construct()
    {
        $this->allergene = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function isClickncollect(): ?bool
    {
        return $this->clickncollect;
    }

    public function setClickncollect(bool $clickncollect): static
    {
        $this->clickncollect = $clickncollect;

        return $this;
    }

    public function isClickneat(): ?bool
    {
        return $this->clickneat;
    }

    public function setClickneat(bool $clickneat): static
    {
        $this->clickncollect = $clickneat;

        return $this;
    }

    public function isPlatDuJour(): ?bool
    {
        return $this->platDuJour;
    }

    public function setPlatDuJour(bool $platDuJour): static
    {
        $this->platDuJour = $platDuJour;

        return $this;
    }

    public function isSpecialite(): ?bool
    {
        return $this->specialite;
    }

    public function setSpecialite(bool $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): static
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection<int, Allergene>
     */
    public function getAllergene(): Collection
    {
        return $this->allergene;
    }

    public function addAllergene(Allergene $allergene): static
    {
        if (!$this->allergene->contains($allergene)) {
            $this->allergene->add($allergene);
        }

        return $this;
    }

    public function removeAllergene(Allergene $allergene): static
    {
        $this->allergene->removeElement($allergene);

        return $this;
    }
}
