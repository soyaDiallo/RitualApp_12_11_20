<?php

namespace App\Entity;


use App\Repository\CommandeRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 *
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateLancement;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateAnnulation;

    /**
     * @ORM\ManyToOne(targetEntity=Consommateur::class, inversedBy="commandes")
     * 
     */
    private $consommateur;

    /**
     * @ORM\ManyToOne(targetEntity=PositionFavorite::class, inversedBy="commandes")
     * 
     */
    private $positionFavorite;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="commandes")
     * 
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="commandes")
     * 
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=ArticleCommande::class, mappedBy="commande")
     * 
     */
    private $articleCommandes;

    /**
     * @ORM\OneToMany(targetEntity=CommandeSupplement::class, mappedBy="commande")
     * 
     */
    private $commandeSupplements;

    public function __construct()
    {
        $this->articleCommandes = new ArrayCollection();
        $this->commandeSupplements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateLancement(): ?DateTimeInterface
    {
        return $this->dateLancement;
    }

    public function setDateLancement(\DateTimeInterface $dateLancement): self
    {
        $this->dateLancement = $dateLancement;

        return $this;
    }

    public function getDateAnnulation(): ?DateTimeInterface
    {
        return $this->dateAnnulation;
    }

    public function setDateAnnulation(\DateTimeInterface $dateAnnulation): self
    {
        $this->dateAnnulation = $dateAnnulation;

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

    public function getPositionFavorite(): ?PositionFavorite
    {
        return $this->positionFavorite;
    }

    public function setPositionFavorite(?PositionFavorite $positionFavorite): self
    {
        $this->positionFavorite = $positionFavorite;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection|ArticleCommande[]
     */
    public function getArticleCommandes(): Collection
    {
        return $this->articleCommandes;
    }

    public function addArticleCommande(ArticleCommande $articleCommande): self
    {
        if (!$this->articleCommandes->contains($articleCommande)) {
            $this->articleCommandes[] = $articleCommande;
            $articleCommande->setCommande($this);
        }

        return $this;
    }

    public function removeArticleCommande(ArticleCommande $articleCommande): self
    {
        if ($this->articleCommandes->contains($articleCommande)) {
            $this->articleCommandes->removeElement($articleCommande);
            // set the owning side to null (unless already changed)
            if ($articleCommande->getCommande() === $this) {
                $articleCommande->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeSupplement[]
     */
    public function getCommandeSupplements(): Collection
    {
        return $this->commandeSupplements;
    }

    public function addCommandeSupplement(CommandeSupplement $commandeSupplement): self
    {
        if (!$this->commandeSupplements->contains($commandeSupplement)) {
            $this->commandeSupplements[] = $commandeSupplement;
            $commandeSupplement->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeSupplement(CommandeSupplement $commandeSupplement): self
    {
        if ($this->commandeSupplements->contains($commandeSupplement)) {
            $this->commandeSupplements->removeElement($commandeSupplement);
            // set the owning side to null (unless already changed)
            if ($commandeSupplement->getCommande() === $this) {
                $commandeSupplement->setCommande(null);
            }
        }

        return $this;
    }
}
