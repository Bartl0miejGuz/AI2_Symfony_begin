<?php

namespace App\Form;

use App\Entity\Location;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;
use Symfony\Component\Validator\Constraints as Assert;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $groups = ['create', 'edit'];

        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Enter city name',
                ],
                'constraints' => [
                    new Assert\NotBlank(groups: $groups),
                    new Assert\Length(
                        min: 2,
                        max: 100,
                        groups: $groups
                    ),
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'France' => 'FR',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'United Kingdom' => 'GB',
                    'United States' => 'US',
                ],
                'placeholder' => 'Select country',
                'constraints' => [
                    new Assert\NotBlank(groups: $groups),
                ],
            ])
            ->add('latitude', NumberType::class, [
                'required' => false,
                'scale' => 6,
                'constraints' => [
                    new Assert\Range(
                        min: -90,
                        max: 90,
                        groups: $groups
                    ),
                ],
            ])
            ->add('longitude', NumberType::class, [
                'required' => false,
                'scale' => 6,
                'constraints' => [
                    new Assert\Range(
                        min: -180,
                        max: 180,
                        groups: $groups
                    ),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
