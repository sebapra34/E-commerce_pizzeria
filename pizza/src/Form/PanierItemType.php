<?php

namespace App\Form;

use App\Entity\OrderItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanierItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ajout des champs dont on a besoin pour les produits dans le panier
        $builder
            ->add('quantity')
            ->add('remove', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderItem::class,
        ]);
    }
}
