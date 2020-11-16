<?php

namespace App\Entity;


use App\Repository\PositionFavoriteRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionFavoriteRepository::class)
 */
class PositionFavorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     *
     * 
     */
    private $titre;

    /**
     * @ORM\Column(type="float")
     * 
     * 
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     * 
     * 
     */
    private $latitude;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * 
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * 
     */
    private $dateDesactivation;

    /**
     * @ORM\ManyToOne(targetEntity=Consommateur::class, inversedBy="positionFavorites")
     * 
     */
    private $consommateur;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="positionFavorite")
     * 
     */
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
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

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getDateCreation(): ?DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateDesactivation(): ?DateTimeInterface
    {
        return $this->dateDesactivation;
    }

    public function setDateDesactivation(\DateTimeInterface $dateDesactivation): self
    {
        $this->dateDesactivation = $dateDesactivation;

        return $this;
    }

    public function getConsommateur(): ?Consommateur
    {
        return $this->consommateur;
    }

    public function setConsommateur(?Consommateur $consommateur): self
    {
        $this->consommateur = $consommateur;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setPositionFavorite($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getPositionFavorite() === $this) {
                $commande->setPositionFavorite(null);
            }
        }

        return $this;
    }
}
