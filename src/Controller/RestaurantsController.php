<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
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
        int $id = 0
    ): Response {
        return $this->render('restaurants/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
        ]);
    }
}
