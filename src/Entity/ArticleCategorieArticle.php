<?php

namespace App\Entity;


use App\Repository\ArticleCategorieArticleRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleCategorieArticleRepository::class)
 * 
 */
class ArticleCategorieArticle
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
    private $dateDesactivation;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleCategorieArticles")
     * 
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieArticle::class, inversedBy="articleCategorieArticles")
     * 
     */
    private $categorieArticle;
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategorieArticle(): ?CategorieArticle
    {
        return $this->categorieArticle;
    }

    public function setCategorieArticle(?CategorieArticle $categorieArticle): self
    {
        $this->categorieArticle = $categorieArticle;

        return $this;
    }
}
