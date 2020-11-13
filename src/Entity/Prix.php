<?php

namespace App\Entity;


use App\Repository\PrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=PrixRepository::class)
 */
class Prix
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     *
     * 
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * 
     */
    private $devise;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSupplementPrix::class, mappedBy="prix")
     * 
     */
    private $articleSupplementPrixes;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePrix::class, mappedBy="prix")
     * 
     */
    private $articlePrixes;

    public function __construct()
    {
        $this->articleSupplementPrixes = new ArrayCollection();
        $this->articlePrixes = new ArrayCollection();

        $this->montant = 0;
        $this->devise = "Dh";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * @return Collection|ArticleSupplementPrix[]
     */
    public function getArticleSupplementPrixes(): Collection
    {
        return $this->articleSupplementPrixes;
    }

    public function addArticleSupplementPrix(ArticleSupplementPrix $articleSupplementPrix): self
    {
        if (!$this->articleSupplementPrixes->contains($articleSupplementPrix)) {
            $this->articleSupplementPrixes[] = $articleSupplementPrix;
            $articleSupplementPrix->setPrix($this);
        }

        return $this;
    }

    public function removeArticleSupplementPrix(ArticleSupplementPrix $articleSupplementPrix): self
    {
        if ($this->articleSupplementPrixes->contains($articleSupplementPrix)) {
            $this->articleSupplementPrixes->removeElement($articleSupplementPrix);
            // set the owning side to null (unless already changed)
            if ($articleSupplementPrix->getPrix() === $this) {
                $articleSupplementPrix->setPrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticlePrix[]
     */
    public function getArticlePrixes(): Collection
    {
        return $this->articlePrixes;
    }

    public function addArticlePrix(ArticlePrix $articlePrix): self
    {
        if (!$this->articlePrixes->contains($articlePrix)) {
            $this->articlePrixes[] = $articlePrix;
            $articlePrix->setPrix($this);
        }

        return $this;
    }

    public function removeArticlePrix(ArticlePrix $articlePrix): self
    {
        if ($this->articlePrixes->contains($articlePrix)) {
            $this->articlePrixes->removeElement($articlePrix);
            // set the owning side to null (unless already changed)
            if ($articlePrix->getPrix() === $this) {
                $articlePrix->setPrix(null);
            }
        }

        return $this;
    }
}
