<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Commande;
use App\Entity\ArticleCommande;
use App\Entity\CommandeSupplement;
use App\Repository\RestaurantRepository;
use App\Repository\ArticleRepository;
use App\Repository\SupplementRepository;
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
        $session->set("resto", $id);
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
        RestaurantRepository $restaurantRepository,
        SessionInterface $session,
        ArticleRepository $articleRepository,
        SupplementRepository $supplementRepository
    ) {
        //  dd($session->get("panier"), $session->get("resto"), $session->get("lat"));

        $entityManager = $this->getDoctrine()->getManager();
        $consommateur = $this->getUser();
        $resto = $restaurantRepository->find($session->get("resto"));
        $panier = $session->get("panier");
        $ac = [];
        $cs = [];

        if (!$session->has("lng") || !$session->has("lat")) {
            $this->addFlash("panier_error", "Veuiller commencer par choisir un lieu.");
            return $this->redirectToRoute('consommateur_index');
        } else {
            $commande = new Commande();
            $commande->setLongitude($session->get("lng"));
            $commande->setLatitude($session->get("lat"));
            $commande->setDateCreation(new \DateTime());
            $commande->setDateLancement(new \DateTime());
            $commande->setConsommateur($consommateur);
            $commande->setRestaurant($resto);
            $entityManager->persist($commande);
            $entityManager->flush();

            foreach ($panier as $key => $a) {
                $ac[$key] = new ArticleCommande();
                $ac[$key]->setQuantite(1);
                $ac[$key]->setCommande($commande);
                $ac[$key]->setArticle($articleRepository->find($a['id']));
                $entityManager->persist($ac[$key]);
                $entityManager->flush();

                foreach ($a['supplements'] as $key => $s) {
                    $cs[$key] = new CommandeSupplement();
                    $cs[$key]->setQuantite(1);
                    $cs[$key]->setCommande($commande);
                    $cs[$key]->setSupplement($supplementRepository->find($s['id']));
                    $entityManager->persist($cs[$key]);
                    $entityManager->flush();
                }
            }

            $session->remove("panier");
            $this->addFlash("panier_valid", "La commande a été lancer.");
            
            return $this->redirectToRoute('consommateur_index');
        }
    }
}
