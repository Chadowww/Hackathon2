<?php

namespace App\Form;

use App\Entity\PhoneCondition;
use App\Entity\Smartphone;
use App\Entity\Storage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class SmartphoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('hasCharger',
            CheckboxType::class, [
                'label' => 'Avec chargeur ?',
                'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                            'message' => 'Vous devez sélectionner si le chargeur est fourni ou pas.',
                        ]),
                    ],
            ])
            ->add('storage', EntityType::class, [
                'class' => Storage::class,
                'choice_label' => 'go_storage',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
                'placeholder' => 'Sélectionnez',
                'constraints' => [
                    new NotBlank(['message' => 'La capacité de stockage est requise.'])
                ],
            ])
            ->add('phoneCondition', EntityType::class, [
                'class' => PhoneCondition::class,
                'choice_label' => 'overall_condition',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
                'placeholder' => 'Sélectionnez',
                'constraints' => [
                    new NotBlank(['message' => 'La condition du téléphone est requise.']),
                ],
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
