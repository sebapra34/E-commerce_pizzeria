<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pizza::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pizza;

     /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    // verifie s'il n'est pas vide ou s'il est = à 1 ou superieur
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
    * 
    *
    * @param OrderItem $item
    *
    * @return bool
    */

    //Test si le produit donné correspond à celui choisis par l'user
    public function equals(OrderItem $item): bool
    {
        return $this->getPizza()->getId() === $item->getPizza()->getId();
    }

 /**
 * 
 *
 * @return float|int
 */
    //Calcul le total du produit si l'utilisateur en a pris plusieurs.
    public function getTotal(): float
    {
        return $this->getPizza()->getPrix() * $this->getQuantity();
    }
}
