<?php

namespace App\Form\EventListener;

use App\Entity\Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RemovePanierItemListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    /**
     * supprime un acticle du panier basé sur la data envoyée par l'utilisateur
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

        // cherche dans un tableau l'article dont le bouton remove est cliqué et le Supprime du panier
        foreach ($form->get('items')->all() as $child) {
            if ($child->get('remove')->isClicked()) {
                $panier->removeItem($child->getData());
                break;
            }
        }
    }
}
