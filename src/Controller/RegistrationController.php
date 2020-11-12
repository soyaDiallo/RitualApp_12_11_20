<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Administrateur;
use App\Entity\Consommateur;
use App\Entity\Restaurant;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $type = $form->get('roles')->getData();
            switch ($type[0]) {
                case "ROLE_CONSOMMATEUR":
                    $consommateur = new Consommateur();
                    $consommateur->setNom($user->getNom());
                    $consommateur->setPhotoUrl($user->getPhotoUrl());
                    $consommateur->setEmail($user->getEmail());
                    $consommateur->setTelephone($user->getTelephone());
                    $consommateur->setDateCreation(new \DateTime());
                    $consommateur->setPassword($user->getPassword());
                    $user = $consommateur;
                    $role = ['ROLE_CONSOMMATEUR'];
                    break;
                case 'ROLE_RESTAURANT':
                    $resto = new Restaurant();
                    $resto->setNom($user->getNom());
                    $resto->setPhotoUrl($user->getPhotoUrl());
                    $resto->setEmail($user->getEmail());
                    $resto->setTelephone($user->getTelephone());
                    $resto->setDateCreation(new \DateTime());
                    $resto->setPassword($user->getPassword());
                    $user = $resto;
                    $role = ['ROLE_RESTAURANT'];
                    break;
                case 'ROLE_ADMINISTRATEUR':
                    $admin = new Administrateur();
                    $admin->setNom($user->getNom());
                    $admin->setPhotoUrl($user->getPhotoUrl());
                    $admin->setEmail($user->getEmail());
                    $admin->setTelephone($user->getTelephone());
                    $admin->setDateCreation(new \DateTime());
                    $admin->setPassword($user->getPassword());
                    $user = $admin;
                    $role = ['ROLE_ADMINISTRATEUR'];
                    break;

                default:
                    return $this->redirectToRoute('app_login');
                    break;
            }

            $user->setRoles($role);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
