<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function home (AuthenticationUtils $authenticationUtils): Response
    {
        // return new Response('Vous êtes connectés !');
        return $this->render('pizza_accueil.html.twig');
    }




    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // recupere l'erreur de login si il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // dernier username entré part l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('Cette methode peut rester vide - il sera intercepter part la clé logout dans le firewall.');
    }
}
