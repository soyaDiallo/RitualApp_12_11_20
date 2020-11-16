<?php

namespace App\Entity;

use App\Repository\ArticleMenuRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ArticleMenuRepository::class)
 *
 */
class ArticleMenu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * 
     */
    private $dateDesactivation;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="articleMenus")
     * 
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleMenus")
     * 
     */
    private $article;


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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
