<?php

namespace App\Form;

use App\Entity\Sale;
use App\Entity\Store;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('saleDate', DateType::class, [
                'label' => 'Date',
            ])
            ->add('revenue', TextType::class, [
                'label' => 'Chiffre d\'affaire',
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Nombre de boites',
            ])
            ->add('photoBefore', TextType::class, [
                'label' => 'Photo du rayon (début)',
                'required' => false,
            ])
            ->add('photoAfter', TextType::class, [
                'label' => 'Photo du rayon (fin)',
                'required' => false,
            ])
            ->add('listingFile', VichFileType::class, [
                'label' => 'Listing des ventes',
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => true,
            ])
            ->add('store', EntityType::class, [
                'class' => Store::class,
                'label' => 'Points de Vente',
                'choice_label' => 'name',
                'placeholder' => '',
                'attr' => [
                    'class' => 'custom-select'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }
}
