<?php

namespace App\Entity;


use App\Repository\SupplementRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=SupplementRepository::class)
 */
class Supplement
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
     * @ORM\Column(type="string", length=255)
     * 
     * 
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * 
     */
    private $photoUrl;

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
    private $dateSuppression;

    /**
     * @ORM\OneToMany(targetEntity=CommandeSupplement::class, mappedBy="supplement")
     * 
     */
    private $commandeSupplements;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSupplement::class, mappedBy="supplement")
     * 
     */
    private $articleSupplements;

    public function __construct()
    {
        $this->commandeSupplements = new ArrayCollection();
        $this->articleSupplements = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    public function setPhotoUrl(string $photoUrl): self
    {
        $this->photoUrl = $photoUrl;

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

    public function getDateSuppression(): ?DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

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
            $commandeSupplement->setSupplement($this);
        }

        return $this;
    }

    public function removeCommandeSupplement(CommandeSupplement $commandeSupplement): self
    {
        if ($this->commandeSupplements->contains($commandeSupplement)) {
            $this->commandeSupplements->removeElement($commandeSupplement);
            // set the owning side to null (unless already changed)
            if ($commandeSupplement->getSupplement() === $this) {
                $commandeSupplement->setSupplement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleSupplement[]
     */
    public function getArticleSupplements(): Collection
    {
        return $this->articleSupplements;
    }

    public function addArticleSupplement(ArticleSupplement $articleSupplement): self
    {
        if (!$this->articleSupplements->contains($articleSupplement)) {
            $this->articleSupplements[] = $articleSupplement;
            $articleSupplement->setSupplement($this);
        }

        return $this;
    }

    public function removeArticleSupplement(ArticleSupplement $articleSupplement): self
    {
        if ($this->articleSupplements->contains($articleSupplement)) {
            $this->articleSupplements->removeElement($articleSupplement);
            // set the owning side to null (unless already changed)
            if ($articleSupplement->getSupplement() === $this) {
                $articleSupplement->setSupplement(null);
            }
        }

        return $this;
    }
}
