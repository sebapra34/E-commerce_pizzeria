<?php


namespace App\Factory;


use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Pizza;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * 
     *
     * @return Order
     */
    //Créer une commande.
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_PANIER)
            ->setCreateAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    /**
     *
     *
     * @param Pizza $pizza
     *
     * @return OrderItem
     */
    
    //Créer un item pour un produit.
    public function createItem(Pizza $pizza): OrderItem
    {
        $item = new OrderItem();
        $item->setPizza($pizza);
        $item->setQuantity(1);

        return $item;
    }
} 
