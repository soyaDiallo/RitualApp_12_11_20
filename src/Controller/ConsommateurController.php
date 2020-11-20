<?php

namespace App\Controller;

use App\Entity\Consommateur;
use App\Form\ConsommateurType;
use App\Repository\CategorieRestaurantRepository;
use App\Repository\CategorieRestaurantRestaurantRepository;
use App\Repository\ConsommateurRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

/**
 * @Route("/consommateur")
 * @Security("is_granted('ROLE_CONSOMMATEUR')")
 */
class ConsommateurController extends AbstractController
{
    /**
     * @Route("/", name="consommateur_index", methods={"GET"})
     */
    public function index(
        CategorieRestaurantRestaurantRepository $crr,
        RestaurantRepository $restaurantRepository,
        CategorieRestaurantRepository $cr,
        SessionInterface $session
    ): Response {
        $categoriesRestaurants = $cr->findBy(["dateDesactivation" => null], ["titre" => "ASC"]);
        $categorieRestaurantRestaurant = [];

        foreach ($categoriesRestaurants as $key => $value) {
            $categorieRestaurantRestaurant[$key][] = $value;
            $categorieRestaurantRestaurant[$key][] = $crr->count(["dateSortie" => null, "categorieRestaurant" => $value->getId()]);
        }

        $panier = [];
        $total = 0;
        if ($session->has("panier")) {
            $panier = $session->get("panier");
            foreach ($panier as $value) {
                $total += intval($value["montant"]);
                if ($value["supplements"]) {
                    foreach ($value["supplements"] as $valueSupp) {
                        $total += intval($valueSupp['montant']);
                    }
                }
            }
        }

        return $this->render('consommateur/index.html.twig', [
            'restaurants' => $restaurantRepository->findBy([], ["nom" => "ASC"]),
            'filtres' => $categorieRestaurantRestaurant,
            'panier' => $panier,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/restaurants/zone/{zone}", name="restaurants_zone", methods={"GET"})
     */
    public function getRestaurantByZone(
        CategorieRestaurantRestaurantRepository $crr,
        RestaurantRepository $restaurantRepository,
        CategorieRestaurantRepository $cr,
        SessionInterface $session,
        string $zone
    ): Response {
        $categoriesRestaurants = $cr->findBy(["dateDesactivation" => null], ["titre" => "ASC"]);
        $categorieRestaurantRestaurant = [];

        foreach ($categoriesRestaurants as $key => $value) {
            $categorieRestaurantRestaurant[$key][] = $value;
            $categorieRestaurantRestaurant[$key][] = $crr->count(["dateSortie" => null, "categorieRestaurant" => $value->getId()]);
        }

        $panier = [];
        $total = 0;
        if ($session->has("panier")) {
            $panier = $session->get("panier");

            foreach ($panier as $value) {
                $total += intval($value["montant"]);
                if ($value["supplements"]) {
                    foreach ($value["supplements"] as $valueSupp) {
                        $total += intval($valueSupp['montant']);
                    }
                }
            }
        }

        return $this->render('consommateur/index.html.twig', [
            'restaurants' => $restaurantRepository->findBy(["zone" => $zone], ["nom" => "ASC"]),
            'filtres' => $categorieRestaurantRestaurant,
            'panier' => $panier,
            'total' => $total,
            'titre' => $zone,
        ]);
    }

    /**
     * @Route("/restaurants/categorie/{categorie}", name="restaurants_categorie", methods={"GET"})
     */
    public function getRestaurantByCategorie(
        CategorieRestaurantRestaurantRepository $crr,
        RestaurantRepository $restaurantRepository,
        CategorieRestaurantRepository $cr,
        SessionInterface $session,
        int $categorie
    ): Response {
        $categoriesRestaurants = $cr->findBy(["dateDesactivation" => null], ["titre" => "ASC"]);
        $categorieRestaurantRestaurant = [];

        foreach ($categoriesRestaurants as $key => $value) {
            $categorieRestaurantRestaurant[$key][] = $value;
            $categorieRestaurantRestaurant[$key][] = $crr->count(["dateSortie" => null, "categorieRestaurant" => $value->getId()]);
        }

        $panier = [];
        $total = 0;
        if ($session->has("panier")) {
            $panier = $session->get("panier");

            foreach ($panier as $value) {
                $total += intval($value["montant"]);
                if ($value["supplements"]) {
                    foreach ($value["supplements"] as $valueSupp) {
                        $total += intval($valueSupp['montant']);
                    }
                }
            }
        }

        $categorieRestaurant = $cr->find($categorie);
        $categorieRestaurantsR = $crr->findBy(["categorieRestaurant" => $categorieRestaurant->getId()]);
        $restaurants = [];

        foreach ($categorieRestaurantsR as $key => $value) {
            $restaurants[] = $value->getRestaurant();
        }

        return $this->render('consommateur/index.html.twig', [
            'restaurants' => $restaurants,
            'filtres' => $categorieRestaurantRestaurant,
            'categorie' => $categorieRestaurant,
            'panier' => $panier,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/position", name="position", methods={"GET","POST"})
     */
    public function position(
        Request $request,
        SessionInterface $session
    ): Response {
        if ($request->request->get('lat') && $request->request->get('lng')) {
            $session->set("lat", $request->request->get('lat'));
            $session->set("lng", $request->request->get('lng'));
            $session->set("zone", "Hassami");
        } else {
            $session->set("lat", "33.57596");
            $session->set("lng", "-7.67666");
            $session->set("zone", $request->request->get('zone'));
        }

        return $this->redirectToRoute('restaurants_zone', ["zone" => $session->get("zone")]);
    }

    /**
     * @Route("/new", name="consommateur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $consommateur = new Consommateur();
        $form = $this->createForm(ConsommateurType::class, $consommateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consommateur);
            $entityManager->flush();

            return $this->redirectToRoute('consommateur_index');
        }

        return $this->render('consommateur/new.html.twig', [
            'consommateur' => $consommateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consommateur_show", methods={"GET"})
     */
    public function show(Consommateur $consommateur): Response
    {
        return $this->render('consommateur/show.html.twig', [
            'consommateur' => $consommateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="consommateur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Consommateur $consommateur): Response
    {
        $form = $this->createForm(ConsommateurType::class, $consommateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('consommateur_index');
        }

        return $this->render('consommateur/edit.html.twig', [
            'consommateur' => $consommateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="consommateur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Consommateur $consommateur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $consommateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($consommateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('consommateur_index');
    }
}
