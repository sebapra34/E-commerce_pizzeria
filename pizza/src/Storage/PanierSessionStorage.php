<?php

namespace App\Storage;


use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierSessionStorage
{
    /**
     * 
     *
     * @var RequestStack
     */

    //la requete stack.
    private $requestStack;

    /**
     * 
     *
     * @var OrderRepository
     */

    //le repository du panier.
    private $panierRepository;

    /**
     * @var string
     */
    const PANIER_KEY_NAME = 'panier_id';

    /**
     * 
     *
     * @param RequestStack $requestStack
     * @param OrderRepository $panierRepository
     */

    //PanierSessionStorage constructor.
    public function __construct(RequestStack $requestStack, OrderRepository $panierRepository) 
    {
        $this->requestStack = $requestStack;
        $this->panierRepository = $panierRepository;
    }

    /**
     *
     *
     * @return Order|null
     */

    // Recupere le panier dans la session.
    public function getPanier(): ?Order
    {
        return $this->panierRepository->findOneBy([
            'id' => $this->getPanierId(),
            'status' => Order::STATUS_PANIER
        ]);
    }

    /**
     *
     *
     * @param Order $panier
     */
    
    // Ajout le panier dans la session.
    public function setPanier(Order $panier): void
    {
        $this->getSession()->set(self::PANIER_KEY_NAME, $panier->getId());
    }

    /**
     * 
     *
     * @return int|null
     */

     // Returne l'id du panier.
    private function getPanierId(): ?int
    {
        return $this->getSession()->get(self::PANIER_KEY_NAME);
    }

        private function getSession(): SessionInterface
        {
            return $this->requestStack->getSession();
    }
}
