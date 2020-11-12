<?php

namespace App\Entity;


use App\Repository\HoraireMenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoraireMenuRepository::class)
 * 
 */
class HoraireMenu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * 
     * 
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="integer")
     * 
     * 
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateSuppression;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="horaireMenus")
     * 
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity=Horaire::class, inversedBy="horaireMenus")
     * 
     */
    private $horaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?int
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(int $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateSuppression(): ?DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaire $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }
}
