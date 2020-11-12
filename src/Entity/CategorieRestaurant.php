<?php

namespace App\Entity;


use App\Repository\CategorieRestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRestaurantRepository::class)
 * 
 */
class CategorieRestaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
    private $dateDesactivation;

    /**
     * @ORM\OneToMany(targetEntity=CategorieRestaurantRestaurant::class, mappedBy="categorieRestaurant")
     * 
     */
    private $categorieRestaurantRestaurants;

    public function __construct()
    {
        $this->categorieRestaurantRestaurants = new ArrayCollection();
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

    /**
     * @return Collection|CategorieRestaurantRestaurant[]
     */
    public function getCategorieRestaurantRestaurants(): Collection
    {
        return $this->categorieRestaurantRestaurants;
    }

    public function addCategorieRestaurantRestaurant(CategorieRestaurantRestaurant $categorieRestaurantRestaurant): self
    {
        if (!$this->categorieRestaurantRestaurants->contains($categorieRestaurantRestaurant)) {
            $this->categorieRestaurantRestaurants[] = $categorieRestaurantRestaurant;
            $categorieRestaurantRestaurant->setCategorieRestaurant($this);
        }

        return $this;
    }

    public function removeCategorieRestaurantRestaurant(CategorieRestaurantRestaurant $categorieRestaurantRestaurant): self
    {
        if ($this->categorieRestaurantRestaurants->contains($categorieRestaurantRestaurant)) {
            $this->categorieRestaurantRestaurants->removeElement($categorieRestaurantRestaurant);
            // set the owning side to null (unless already changed)
            if ($categorieRestaurantRestaurant->getCategorieRestaurant() === $this) {
                $categorieRestaurantRestaurant->setCategorieRestaurant(null);
            }
        }

        return $this;
    }
}
