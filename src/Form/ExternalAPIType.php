<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;

class ExternalAPIType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('latitude', NumberType::class, [
                'constraints' => [new NotNull(), new Range(min: -90, max: 90)],
            ])
            ->add('longitude', NumberType::class, [
                'constraints' => [new NotNull(), new Range(min: -180, max: 180)],
            ]);
    }
}
