<?php

namespace App\Controller;

use App\Repository\ArticleMenuRepository;
use App\Repository\ArticlePrixRepository;
use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/restaurants")
 */
class RestaurantsController extends AbstractController
{
    /**
     * @Route("/{id}", name="restaurants_index", methods={"GET"})
     */
    public function index(
        RestaurantRepository $restaurantRepository,
        MenuRepository $menuRepository,
        ArticleMenuRepository $articleMenuRepository,
        ArticlePrixRepository $articlePrixRepository,
        int $id = 0
    ): Response {
        $menus = $menuRepository->findBy(["restaurant" => $id]);
        $menusArticles = [];

        foreach ($menus as $key => $value) {
            $menusArticles[$key][0] = $value;
            $menusArticles[$key][1] = $articleMenuRepository->findBy(["dateDesactivation" => null, "menu" => $value->getId()]);
            foreach ($menusArticles[$key][1] as $valueArticle) {
                $menusArticles[$key][2][$valueArticle->getArticle()->getId()] = $articlePrixRepository->findBy(["article" => $valueArticle->getArticle()->getId()], ["date" => "DESC"], 1);
            }
        }

        //  dd($menusArticles);

        return $this->render('restaurants/index.html.twig', [
            'restaurant' => $restaurantRepository->find($id),
            'menus' => $menusArticles,
        ]);
    }
}
