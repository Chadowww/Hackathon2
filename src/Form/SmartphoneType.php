<?php

namespace App\Form;

use App\Entity\PhoneCondition;
use App\Entity\Smartphone;
use App\Entity\Storage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmartphoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('hasCharger')
            ->add('phoneCondition', EntityType::class, [
                'class' => PhoneCondition::class,
                'choice_label' => 'overall_condition',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
            ])
            ->add('storage', EntityType::class, [
                'class' => Storage::class,
                'choice_label' => 'go_storage',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Smartphone::class,
        ]);
    }
}
