<?php

namespace App\Controller;

use App\Form\PanierType;
use App\Manager\PanierManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierManager $panierManager, Request $request): Response
    {
        //recupere le panier de l'utilisateur en utilisant le PanierManager
        $panier = $panierManager->getCurrentPanier();
        $form = $this->createForm(PanierType::class, $panier);

        $form->handleRequest($request);

        //si le form est submit et s'il est valide modifie la date et le save dans la BDD et le SessionStorage
        if ($form->isSubmitted() && $form->isValid()) {
            $panier->setUpdatedAt(new \DateTime());
            $panierManager->save($panier);

            return $this->redirectToRoute('panier');
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
            'form' => $form->createView()
        ]);
    }


}
