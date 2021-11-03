<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\AddToPanierType;
use App\Manager\PanierManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza{id}", name="pizza.detail")
     */

    public function detail(Pizza $pizza, Request $request, PanierManager $panierManager)
    {

        
        $form = $this->createForm(AddToPanierType::class);

        $form->handleRequest($request);

        //si le form est submit et valide envoie la pizza dans le panier de l'utilisateur
        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setPizza($pizza);

            $panier = $panierManager->getCurrentPanier();
            $panier
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $panierManager->save($panier);

            return $this->redirectToRoute('pizza.detail', ['id' => $pizza->getId()]);
        }

        //recupere l'id du produit de l'URL et le passe au template
        return $this->render('pizza/detail.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView()
        ]);
    }
}
