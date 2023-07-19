<?php

namespace App\Form;

use App\Entity\Sale;
use App\Entity\Store;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('saleDate')
            ->add('revenue')
            ->add('quantity')
            ->add('photoBefore')
            ->add('photoAfter')
            ->add('listing')
            //->add('seller', null)
            ->add('store', null, ['choice_label' => 'name']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }
}
