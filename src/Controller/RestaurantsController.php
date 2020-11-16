<?php

namespace App\Controller;

use App\Repository\ArticleMenuRepository;
use App\Repository\ArticlePrixRepository;
use App\Repository\ArticleSupplementPrixRepository;
use App\Repository\ArticleSupplementRepository;
use App\Repository\GroupeSupplementRepository;
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
        ArticleSupplementRepository $articleSupplementRepository,
        ArticleSupplementPrixRepository $articleSupplementPrixRepository,
        GroupeSupplementRepository $groupeSupplementRepository,
        int $id = 0
    ): Response {
        $menus = $menuRepository->findBy(["restaurant" => $id]);
        $groupesSupplements = $groupeSupplementRepository->findAll();

        $menusArticles = [];

        foreach ($menus as $key => $value) {
            $menusArticles[$key][0] = $value;
            $menusArticles[$key][1] = $articleMenuRepository->findBy(["dateDesactivation" => null, "menu" => $value->getId()]);

            foreach ($menusArticles[$key][1] as $valueArticle) {
                $menusArticles[$key][2][$valueArticle->getArticle()->getId()] = $articlePrixRepository->findBy(["article" => $valueArticle->getArticle()->getId()], ["date" => "DESC"], 1);
                foreach ($groupesSupplements as $valueGroupe) {
                    $temp = $articleSupplementRepository->findBy(["article" => $valueArticle->getArticle()->getId(), "groupeSupplement" => $valueGroupe->getId(), "dateDesactivation" => null]);
                    if ($temp) {
                        $menusArticles[$key][3][$valueArticle->getArticle()->getId()][$valueGroupe->getId()][0] = $valueGroupe;
                        $menusArticles[$key][3][$valueArticle->getArticle()->getId()][$valueGroupe->getId()][1] = $temp;
                        foreach ($temp as $valueTemp) {
                            $menusArticles[$key][3][$valueArticle->getArticle()->getId()][$valueGroupe->getId()][2][$valueTemp->getId()] = $articleSupplementPrixRepository->findBy(["articleSupplement" => $valueTemp->getId()], ["date" => "DESC"], 1);
                        }
                    }
                }
            }
        }

        return $this->render('restaurants/index.html.twig', [
            'restaurant' => $restaurantRepository->find($id),
            'menus' => $menusArticles,
        ]);
    }
}
