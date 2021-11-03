<?php

namespace App\Form;

use App\Entity\Order;
use App\Form\EventListener\ClearPanierListener;
use App\Form\EventListener\RemovePanierItemListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ajout des champs dont on a besoin pour le panier
        $builder
            ->add('items', CollectionType::class, [
                'entry_type' => PanierItemType::class
            ])
            ->add('save', SubmitType::class)
            ->add('clear', SubmitType::class);

        $builder->addEventSubscriber(new RemovePanierItemListener());
        $builder->addEventSubscriber(new ClearPanierListener());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
