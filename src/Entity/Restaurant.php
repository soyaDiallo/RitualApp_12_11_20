<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant extends User
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slogan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true) 
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="restaurant")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="restaurant")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=HoraireRestaurant::class, mappedBy="restaurant")
     */
    private $horaireRestaurants;

    /**
     * @ORM\OneToMany(targetEntity=CategorieRestaurantRestaurant::class, mappedBy="restaurant")
     */
    private $categorieRestaurantRestaurants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zone;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->horaireRestaurants = new ArrayCollection();
        $this->categorieRestaurantRestaurants = new ArrayCollection();
    }
    
    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setRestaurant($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getRestaurant() === $this) {
                $menu->setRestaurant(null);
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
            $commande->setRestaurant($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getRestaurant() === $this) {
                $commande->setRestaurant(null);
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
            $horaireRestaurant->setRestaurant($this);
        }

        return $this;
    }

    public function removeHoraireRestaurant(HoraireRestaurant $horaireRestaurant): self
    {
        if ($this->horaireRestaurants->contains($horaireRestaurant)) {
            $this->horaireRestaurants->removeElement($horaireRestaurant);
            // set the owning side to null (unless already changed)
            if ($horaireRestaurant->getRestaurant() === $this) {
                $horaireRestaurant->setRestaurant(null);
            }
        }

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
            $categorieRestaurantRestaurant->setRestaurant($this);
        }

        return $this;
    }

    public function removeCategorieRestaurantRestaurant(CategorieRestaurantRestaurant $categorieRestaurantRestaurant): self
    {
        if ($this->categorieRestaurantRestaurants->contains($categorieRestaurantRestaurant)) {
            $this->categorieRestaurantRestaurants->removeElement($categorieRestaurantRestaurant);
            // set the owning side to null (unless already changed)
            if ($categorieRestaurantRestaurant->getRestaurant() === $this) {
                $categorieRestaurantRestaurant->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }
}
