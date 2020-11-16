<?php

namespace App\Entity;

use App\Repository\GroupeSupplementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeSupplementRepository::class)
 */
class GroupeSupplement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSupplement::class, mappedBy="groupeSupplement")
     */
    private $articleSupplements;

    public function __construct()
    {
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
            $articleSupplement->setGroupeSupplement($this);
        }

        return $this;
    }

    public function removeArticleSupplement(ArticleSupplement $articleSupplement): self
    {
        if ($this->articleSupplements->removeElement($articleSupplement)) {
            // set the owning side to null (unless already changed)
            if ($articleSupplement->getGroupeSupplement() === $this) {
                $articleSupplement->setGroupeSupplement(null);
            }
        }

        return $this;
    }
}
