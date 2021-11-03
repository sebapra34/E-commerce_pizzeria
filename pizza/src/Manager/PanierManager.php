<?php

namespace App\Manager;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Storage\PanierSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

class PanierManager
    {
        /**
         * @var PanierSessionStorage
         */
        private $panierSessionStorage;
    
        /**
         * @var OrderFactory
         */
        private $panierFactory;
    
        /**
         * @var EntityManagerInterface
         */
        private $entityManager;
    
        /**
         * 
         *
         * @param PanierSessionStorage $panierStorage
         * @param OrderFactory $orderFactory
         * @param EntityManagerInterface $entityManager
         */
        // Constructeur du PanierManager.
        public function __construct(
            PanierSessionStorage $panierStorage,
            OrderFactory $orderFactory,
            EntityManagerInterface $entityManager
        ) {
            $this->panierSessionStorage = $panierStorage;
            $this->panierFactory = $orderFactory;
            $this->entityManager = $entityManager;
        }
    
        /**
         *
         *
         * @return Order
         */

        //recupere le panier de l'utilisateur
        public function getCurrentPanier(): Order
        {
            $panier = $this->panierSessionStorage->getPanier();
    
            if (!$panier) {
                $panier = $this->panierFactory->create();
            }
    
            return $panier;
        }

        /**
        * 
        *
        * @param Order $panier
        */
        // Sauvegarde le panier dans la database et la session.
        public function save(Order $panier): void
        {
            // sauvegarde le panier dans la base de donnée
            $this->entityManager->persist($panier);
            $this->entityManager->flush();
            // sauvegarde le panier dans le SessionStorage
            $this->panierSessionStorage->setPanier($panier);
        }
    }
