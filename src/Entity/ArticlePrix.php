<?php

namespace App\Entity;

use App\Repository\ArticlePrixRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlePrixRepository::class)
 * 
 */
class ArticlePrix
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
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articlePrixes")
     * 
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=Prix::class, inversedBy="articlePrixes")
     * 
     */
    private $prix;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getPrix(): ?Prix
    {
        return $this->prix;
    }

    public function setPrix(?Prix $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
