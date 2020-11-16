<?php

namespace App\Entity;


use App\Repository\MenuRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
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
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="menus")
     * 
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=ArticleMenu::class, mappedBy="menu")
     * 
     */
    private $articleMenus;

    /**
     * @ORM\OneToMany(targetEntity=HoraireMenu::class, mappedBy="menu")
     * 
     */
    private $horaireMenus;

    public function __construct()
    {
        $this->articleMenus = new ArrayCollection();
        $this->horaireMenus = new ArrayCollection();
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
     * @return Collection|ArticleMenu[]
     */
    public function getArticleMenus(): Collection
    {
        return $this->articleMenus;
    }

    public function addArticleMenu(ArticleMenu $articleMenu): self
    {
        if (!$this->articleMenus->contains($articleMenu)) {
            $this->articleMenus[] = $articleMenu;
            $articleMenu->setMenu($this);
        }

        return $this;
    }

    public function removeArticleMenu(ArticleMenu $articleMenu): self
    {
        if ($this->articleMenus->contains($articleMenu)) {
            $this->articleMenus->removeElement($articleMenu);
            // set the owning side to null (unless already changed)
            if ($articleMenu->getMenu() === $this) {
                $articleMenu->setMenu(null);
            }
        }

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
            $horaireMenu->setMenu($this);
        }

        return $this;
    }

    public function removeHoraireMenu(HoraireMenu $horaireMenu): self
    {
        if ($this->horaireMenus->contains($horaireMenu)) {
            $this->horaireMenus->removeElement($horaireMenu);
            // set the owning side to null (unless already changed)
            if ($horaireMenu->getMenu() === $this) {
                $horaireMenu->setMenu(null);
            }
        }

        return $this;
    }
}
