<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoraireRepository::class)
 * 
 */
class Horaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $jour;

    /**
     * @ORM\OneToMany(targetEntity=HoraireMenu::class, mappedBy="horaire")
     */
    private $horaireMenus;

    /**
     * @ORM\OneToMany(targetEntity=HoraireRestaurant::class, mappedBy="horaire")
     */
    private $horaireRestaurants;

    public function __construct()
    {
        $this->horaireMenus = new ArrayCollection();
        $this->horaireRestaurants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * @return Collection|HoraireMenu[]
     */
    public function getHoraireMenus(): Collection
    {
        return $this->horaireMenus;
    }

    public function addHoraireMenu(HoraireMenu $horaireMenu): self
    {
        if (!$this->horaireMenus->contains($horaireMenu)) {
            $this->horaireMenus[] = $horaireMenu;
            $horaireMenu->setHoraire($this);
        }

        return $this;
    }

    public function removeHoraireMenu(HoraireMenu $horaireMenu): self
    {
        if ($this->horaireMenus->contains($horaireMenu)) {
            $this->horaireMenus->removeElement($horaireMenu);
            // set the owning side to null (unless already changed)
            if ($horaireMenu->getHoraire() === $this) {
                $horaireMenu->setHoraire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HoraireRestaurant[]
     */
    public function getHoraireRestaurants(): Collection
    {
        return $this->horaireRestaurants;
    }

    public function addHoraireRestaurant(HoraireRestaurant $horaireRestaurant): self
    {
        if (!$this->horaireRestaurants->contains($horaireRestaurant)) {
            $this->horaireRestaurants[] = $horaireRestaurant;
            $horaireRestaurant->setHoraire($this);
        }

        return $this;
    }

    public function removeHoraireRestaurant(HoraireRestaurant $horaireRestaurant): self
    {
        if ($this->horaireRestaurants->contains($horaireRestaurant)) {
            $this->horaireRestaurants->removeElement($horaireRestaurant);
            // set the owning side to null (unless already changed)
            if ($horaireRestaurant->getHoraire() === $this) {
                $horaireRestaurant->setHoraire(null);
            }
        }

        return $this;
    }
}
