<?php

namespace App\Entity;

use App\Repository\ConsommateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ConsommateurRepository::class)
 */
class Consommateur extends User
{
    /**
     * @ORM\Id() ORM\@OneToOne(targetEntity="User")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
     **/
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\OneToMany(targetEntity=PositionFavorite::class, mappedBy="consommateur")
     * 
     */
    private $positionFavorites;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="consommateur")
     * 
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=ConsommateurGroupe::class, mappedBy="consommateur")
     * 
     */
    private $consommateurGroupes;

    public function __construct()
    {
        $this->positionFavorites = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->consommateurGroupes = new ArrayCollection();
    }
    /**
     * @return Collection|PositionFavorite[]
     */
    public function getPositionFavorites(): Collection
    {
        return $this->positionFavorites;
    }

    public function addPositionFavorite(PositionFavorite $positionFavorite): self
    {
        if (!$this->positionFavorites->contains($positionFavorite)) {
            $this->positionFavorites[] = $positionFavorite;
            $positionFavorite->setConsommateur($this);
        }

        return $this;
    }

    public function removePositionFavorite(PositionFavorite $positionFavorite): self
    {
        if ($this->positionFavorites->contains($positionFavorite)) {
            $this->positionFavorites->removeElement($positionFavorite);
            // set the owning side to null (unless already changed)
            if ($positionFavorite->getConsommateur() === $this) {
                $positionFavorite->setConsommateur(null);
            }
        }

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
            $commande->setConsommateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getConsommateur() === $this) {
                $commande->setConsommateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ConsommateurGroupe[]
     */
    public function getConsommateurGroupes(): Collection
    {
        return $this->consommateurGroupes;
    }

    public function addConsommateurGroupe(ConsommateurGroupe $consommateurGroupe): self
    {
        if (!$this->consommateurGroupes->contains($consommateurGroupe)) {
            $this->consommateurGroupes[] = $consommateurGroupe;
            $consommateurGroupe->setConsommateur($this);
        }

        return $this;
    }

    public function removeConsommateurGroupe(ConsommateurGroupe $consommateurGroupe): self
    {
        if ($this->consommateurGroupes->contains($consommateurGroupe)) {
            $this->consommateurGroupes->removeElement($consommateurGroupe);
            // set the owning side to null (unless already changed)
            if ($consommateurGroupe->getConsommateur() === $this) {
                $consommateurGroupe->setConsommateur(null);
            }
        }

        return $this;
    }
}
