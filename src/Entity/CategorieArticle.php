<?php

namespace App\Entity;


use App\Repository\CategorieArticleRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieArticleRepository::class)
 * 
 */
class CategorieArticle
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
    private $dateDesactivation;

    /**
     * @ORM\OneToMany(targetEntity=ArticleCategorieArticle::class, mappedBy="categorieArticle")
     * 
     */
    private $articleCategorieArticles;

    public function __construct()
    {
        $this->articleCategorieArticles = new ArrayCollection();
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

    /**
     * @return Collection|ArticleCategorieArticle[]
     */
    public function getArticleCategorieArticles(): Collection
    {
        return $this->articleCategorieArticles;
    }

    public function addArticleCategorieArticle(ArticleCategorieArticle $articleCategorieArticle): self
    {
        if (!$this->articleCategorieArticles->contains($articleCategorieArticle)) {
            $this->articleCategorieArticles[] = $articleCategorieArticle;
            $articleCategorieArticle->setCategorieArticle($this);
        }

        return $this;
    }

    public function removeArticleCategorieArticle(ArticleCategorieArticle $articleCategorieArticle): self
    {
        if ($this->articleCategorieArticles->contains($articleCategorieArticle)) {
            $this->articleCategorieArticles->removeElement($articleCategorieArticle);
            // set the owning side to null (unless already changed)
            if ($articleCategorieArticle->getCategorieArticle() === $this) {
                $articleCategorieArticle->setCategorieArticle(null);
            }
        }

        return $this;
    }
}
