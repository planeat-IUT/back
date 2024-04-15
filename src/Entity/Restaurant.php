<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['restaurant:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['restaurant:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['restaurant:read'])]
    private ?string $complement = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column]
    #[Groups(['restaurant:read'])]
    private ?float $longitude = null;

    #[ORM\Column]
    #[Groups(['restaurant:read'])]
    private ?float $latitude = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $rib = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $logo = null;

    #[ORM\Column]
    #[Groups(['restaurant:read'])]
    private ?int $nb_table = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['restaurant:read'])]
    private ?bool $a_decouvrir = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['restaurant:read'])]
    private ?bool $clickCollect = null;

    #[ORM\Column(length: 255)]
    #[Groups(['restaurant:read'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['restaurant:read'])]
    private ?float $prix = null;

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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): static
    {
        $this->complement = $complement;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(string $rib): static
    {
        $this->rib = $rib;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNbTable(): ?int
    {
        return $this->nb_table;
    }

    public function setNbTable(int $nb_table): static
    {
        $this->nb_table = $nb_table;

        return $this;
    }

    public function isADecouvrir(): ?bool
    {
        return $this->a_decouvrir;
    }

    public function setADecouvrir(?bool $a_decouvrir): static
    {
        $this->a_decouvrir = $a_decouvrir;

        return $this;
    }

    public function isClickCollect(): ?bool
    {
        return $this->clickCollect;
    }

    public function setClickCollect(bool $clickCollect): static
    {
        $this->clickCollect = $clickCollect;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
