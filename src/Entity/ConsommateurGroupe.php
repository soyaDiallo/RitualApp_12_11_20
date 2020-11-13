<?php

namespace App\Entity;

use App\Repository\ConsommateurGroupeRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsommateurGroupeRepository::class)
 * 
 */
class ConsommateurGroupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * 
     * 
     */
    private $role;

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
     * @ORM\ManyToOne(targetEntity=Consommateur::class, inversedBy="consommateurGroupes")
     * 
     */
    private $consommateur;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="consommateurGroupes")
     * 
     */
    private $groupe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
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

    public function getConsommateur(): ?Consommateur
    {
        return $this->consommateur;
    }

    public function setConsommateur(?Consommateur $consommateur): self
    {
        $this->consommateur = $consommateur;

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
}
