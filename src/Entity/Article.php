<?php

namespace App\Entity;


use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
     * @ORM\OneToMany(targetEntity=ArticleCommande::class, mappedBy="article")
     * 
     */
    private $articleCommandes;

    /**
     * @ORM\OneToMany(targetEntity=ArticleMenu::class, mappedBy="article")
     * 
     */
    private $articleMenus;

    /**
     * @ORM\OneToMany(targetEntity=ArticleSupplement::class, mappedBy="article")
     * 
     */
    private $articleSupplements;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePrix::class, mappedBy="article")
     * 
     */
    private $articlePrixes;

    /**
     * @ORM\OneToMany(targetEntity=ArticleCategorieArticle::class, mappedBy="article")
     * 
     */
    private $articleCategorieArticles;


    public function __construct()
    {
        $this->articleCommandes = new ArrayCollection();
        $this->articleMenus = new ArrayCollection();
        $this->articleSupplements = new ArrayCollection();
        $this->articlePrixes = new ArrayCollection();
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    
    public function getDateSuppression(): ?\DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * @return Collection|ArticleCommande[]
     */
    public function getArticleCommandes(): Collection
    {
        return $this->articleCommandes;
    }

    public function addArticleCommande(ArticleCommande $articleCommande): self
    {
        if (!$this->articleCommandes->contains($articleCommande)) {
            $this->articleCommandes[] = $articleCommande;
            $articleCommande->setArticle($this);
        }

        return $this;
    }

    public function removeArticleCommande(ArticleCommande $articleCommande): self
    {
        if ($this->articleCommandes->contains($articleCommande)) {
            $this->articleCommandes->removeElement($articleCommande);
            // set the owning side to null (unless already changed)
            if ($articleCommande->getArticle() === $this) {
                $articleCommande->setArticle(null);
            }
        }

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
            $articleMenu->setArticle($this);
        }

        return $this;
    }

    public function removeArticleMenu(ArticleMenu $articleMenu): self
    {
        if ($this->articleMenus->contains($articleMenu)) {
            $this->articleMenus->removeElement($articleMenu);
            // set the owning side to null (unless already changed)
            if ($articleMenu->getArticle() === $this) {
                $articleMenu->setArticle(null);
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
            $articleSupplement->setArticle($this);
        }

        return $this;
    }

    public function removeArticleSupplement(ArticleSupplement $articleSupplement): self
    {
        if ($this->articleSupplements->contains($articleSupplement)) {
            $this->articleSupplements->removeElement($articleSupplement);
            // set the owning side to null (unless already changed)
            if ($articleSupplement->getArticle() === $this) {
                $articleSupplement->setArticle(null);
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
            $articlePrix->setArticle($this);
        }

        return $this;
    }

    public function removeArticlePrix(ArticlePrix $articlePrix): self
    {
        if ($this->articlePrixes->contains($articlePrix)) {
            $this->articlePrixes->removeElement($articlePrix);
            // set the owning side to null (unless already changed)
            if ($articlePrix->getArticle() === $this) {
                $articlePrix->setArticle(null);
            }
        }

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
            $articleCategorieArticle->setArticle($this);
        }

        return $this;
    }

    public function removeArticleCategorieArticle(ArticleCategorieArticle $articleCategorieArticle): self
    {
        if ($this->articleCategorieArticles->contains($articleCategorieArticle)) {
            $this->articleCategorieArticles->removeElement($articleCategorieArticle);
            // set the owning side to null (unless already changed)
            if ($articleCategorieArticle->getArticle() === $this) {
                $articleCategorieArticle->setArticle(null);
            }
        }

        return $this;
    }

    
}
