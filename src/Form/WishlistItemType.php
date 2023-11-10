<?php

namespace App\Form;

use App\Entity\WishlistItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishlistItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('itemName')
            ->add('itemDescription')
            ->add('itemPrice')
            ->add('itemUrl')
            ->add('itemPicture')
            ->add('createdAt')
            ->add('isActive')
            ->add('isPurchased')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WishlistItem::class,
        ]);
    }
}
