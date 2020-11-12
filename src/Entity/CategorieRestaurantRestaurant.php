<?php

namespace App\Entity;

use App\Repository\CategorieRestaurantRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CategorieRestaurantRestaurantRepository::class)
 * 
 */
class CategorieRestaurantRestaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateEntree;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateSortie;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="categorieRestaurantRestaurants")
     * 
     */
    private $restaurant;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieRestaurant::class, inversedBy="categorieRestaurantRestaurants")
     * 
     */
    private $categorieRestaurant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getDateSortie(): ?DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

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

    public function getCategorieRestaurant(): ?CategorieRestaurant
    {
        return $this->categorieRestaurant;
    }

    public function setCategorieRestaurant(?CategorieRestaurant $categorieRestaurant): self
    {
        $this->categorieRestaurant = $categorieRestaurant;

        return $this;
    }
}
