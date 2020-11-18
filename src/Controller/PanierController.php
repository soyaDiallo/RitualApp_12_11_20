<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/panier")
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/ajouter/article_supplement/panier/{id}", name="panier_add_article_and_supplement_to_panier", methods={"GET", "POST"})
     */
    public function AddArticleAndSupplementToPanier(
        Request $request,
        SessionInterface $session,
        int $id = 0
    ): Response {
        $panier = [];
        if ($session->has("panier")) {
            $panier = $session->get("panier");
        }

        foreach ($request->request->all() as $key => $value) {
            if (explode("_", $key)[0] == "radios") {
                if (!isset($panier[explode("_", $key)[2]])) {
                    $panier[explode("_", $key)[2]] = $request->request->get("articles")[explode("_", $key)[2]][0];
                }
                $panier[explode("_", $key)[2]]["supplements"][$value] = $request->request->get("articles")[explode("_", $key)[2]][1][$value];
            }
            if (explode("_", $key)[0] == "checkbox") {
                foreach ($value as $k => $v) {
                    if (!isset($panier[$k])) {
                        $panier[$k] = $request->request->get("articles")[$k][0];
                    }
                    foreach ($v as $k2 => $v2) {
                        $panier[$k]["supplements"][$k2] = $request->request->get("articles")[$k][1][$k2];
                    }
                }
            }
        }
        $session->set("panier", $panier);
        return $this->redirectToRoute("restaurants_index", ["id" => $id]);
    }

    /**
     * @Route("/supprimer/article/panier/{route}/{id}/{article}", name="panier_remove_article_to_panier", methods={"GET", "POST"})
     */
    public function RemoveArticlePanier(
        int $article = 0,
        string $route = null,
        int $id = 0,
        SessionInterface $session
    ) {
        if ($article != 0) {
            $panier = $session->get("panier");
            unset($panier[$article]);
            $session->set("panier", $panier);
        }

        if ($id != 0) {
            return $this->redirectToRoute($route, ["id" => $id]);
        } else {
            return $this->redirectToRoute($route);
        }
    }

    /**
     * @Route("/supprimer/supplement/panier/{route}/{id}/{article}/{supplement}", name="panier_remove_supplement_to_panier", methods={"GET", "POST"})
     */
    public function RemoveSupplementPanier(
        int $article = 0,
        int $supplement = 0,
        string $route = null,
        int $id = 0,
        SessionInterface $session
    ) {
        if ($article != 0 && $supplement != 0) {
            $panier = $session->get("panier");
            unset($panier[$article]["supplements"][$supplement]);
            $session->set("panier", $panier);
        }

        if ($id != 0) {
            return $this->redirectToRoute($route, ["id" => $id]);
        } else {
            return $this->redirectToRoute($route);
        }
    }

    /**
     * @Route("/supprimer/panier/{route}/{id}", name="panier_remove", methods={"GET", "POST"})
     */
    public function RemovePanier(
        string $route = null,
        int $id = 0,
        SessionInterface $session
    ) {
        $session->remove("panier");
        if ($id != 0) {
            return $this->redirectToRoute($route, ["id" => $id]);
        } else {
            return $this->redirectToRoute($route);
        }
    }

    /**
     * @Route("/valider/panier", name="panier_valid", methods={"GET", "POST"})
     */
    public function ValidPanier(
        RestaurantRepository $restaurantRepository
    ) {
    }
}
