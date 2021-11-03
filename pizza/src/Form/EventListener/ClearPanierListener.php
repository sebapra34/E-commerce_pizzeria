<?php

namespace App\Form\EventListener;

use App\Entity\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ClearPanierListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    /**
     * Supprimer tout les produits du panier quand le bouton "clear" est cliqué
     *
     * @param FormEvent $event
     */
    public function postSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $panier = $form->getData();

        if (!$panier instanceof Order) {
            return;
        }

        // si le bouton clear est cliqué
        if (!$form->get('clear')->isClicked()) {
            return;
        }

        // supprimer le panier
        $panier->removeItems();
    }
}
