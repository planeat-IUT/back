<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'Restaurant', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'Restaurant', targetEntity: Avis::class)]
    private Collection $avis;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Plat::class, orphanRemoval: true)]
    private Collection $plats;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Table::class, orphanRemoval: true)]
    private Collection $tables;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Commande::class, orphanRemoval: true)]
    private Collection $commandes;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->tables = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRestaurant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRestaurant() === $this) {
                $reservation->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setRestaurant($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getRestaurant() === $this) {
                $avi->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): static
    {
        if (!$this->plats->contains($plat)) {
            $this->plats->add($plat);
            $plat->setRestaurant($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): static
    {
        if ($this->plats->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getRestaurant() === $this) {
                $plat->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Table>
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): static
    {
        if (!$this->tables->contains($table)) {
            $this->tables->add($table);
            $table->setRestaurant($this);
        }

        return $this;
    }

    public function removeTable(Table $table): static
    {
        if ($this->tables->removeElement($table)) {
            // set the owning side to null (unless already changed)
            if ($table->getRestaurant() === $this) {
                $table->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setRestaurant($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getRestaurant() === $this) {
                $commande->setRestaurant(null);
            }
        }

        return $this;
    }
}
