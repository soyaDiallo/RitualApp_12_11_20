<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VerificationController extends AbstractController
{
    /**
     * @Route("/verification", name="verification")
     */
    public function index(): Response
    {
        $role = $this->getUser()->getRoles();
        switch ($role[0]) {
            case "ROLE_CONSOMMATEUR":
                return $this->redirectToRoute('consommateur_index');
                break;
            case 'ROLE_RESTAURANT':
                return $this->redirectToRoute('restaurant_index');
                break;
            case 'ROLE_ADMINISTRATEUR':
                return $this->redirectToRoute('administrateur_index');
                break;
            default:
                return $this->redirectToRoute('app_login');
                break;
        }
    }
}
