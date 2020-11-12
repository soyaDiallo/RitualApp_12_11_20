<?php

namespace App\Entity;

use App\Repository\ArticleSupplementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleSupplementRepository::class)
 * 
 */
class ArticleSupplement
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
    private $dateAffectation;

    /**
     * @ORM\Column(type="datetime")
     * 
     * 
     */
    private $dateDesactivation;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleSupplements")
     * 
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=Supplement::class, inversedBy="articleSupplements")
     * 
     */
    private $supplement;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSupplementPrix::class, mappedBy="articleSupplement")
     * 
     */
    private $articleSupplementPrixes;

    public function __construct()
    {
        $this->articleSupplementPrixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAffectation(): ?DateTimeInterface
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(\DateTimeInterface $dateAffectation): self
    {
        $this->dateAffectation = $dateAffectation;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getSupplement(): ?Supplement
    {
        return $this->supplement;
    }

    public function setSupplement(?Supplement $supplement): self
    {
        $this->supplement = $supplement;

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
            $articleSupplementPrix->setArticleSupplement($this);
        }

        return $this;
    }

    public function removeArticleSupplementPrix(ArticleSupplementPrix $articleSupplementPrix): self
    {
        if ($this->articleSupplementPrixes->contains($articleSupplementPrix)) {
            $this->articleSupplementPrixes->removeElement($articleSupplementPrix);
            // set the owning side to null (unless already changed)
            if ($articleSupplementPrix->getArticleSupplement() === $this) {
                $articleSupplementPrix->setArticleSupplement(null);
            }
        }

        return $this;
    }
}