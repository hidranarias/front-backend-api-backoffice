<?php

namespace Pyz\Zed\AntelopeGui\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    protected const FIELD_NAME = 'name';
    protected const FIELD_COLOR = 'color';
    protected const FIELD_GENDER = 'gender';
    protected const FIELD_WEIGHT = 'weight';
    protected const FIELD_AGE = 'age';
    protected const FIELD_TYPE = 'typeId';
    protected const FIELD_LOCATION = 'LocationId';

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }


    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->addNameFiled($builder);
        $this->addColorFiled($builder);
        $this->addGenderFiled($builder);
        $this->addWeightFiled($builder);
        $this->addAgeFiled($builder);
        $this->addTypeFiled($builder, $options);
        $this->addLocationFiled($builder, $options);
    }

    private function addNameFiled(FormBuilderInterface $builder): void
    {
        $builder->add(
            static::FIELD_NAME, TextType::class,
            [
                'label' => 'Name',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank();
    }

    private function addColorFiled(FormBuilderInterface $builder): void
    {
        $builder->add(
            static::FIELD_COLOR, TextType::class,
            [
                'label' => 'Color',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addGenderFiled(FormBuilderInterface $builder): void
    {
        $builder->add(
            static::FIELD_GENDER, TextType::class,
            [
                'label' => 'Gender',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addWeightFiled(FormBuilderInterface $builder): void
    {
        $builder->add(
            static::FIELD_WEIGHT, TextType::class,
            [
                'label' => 'Weight',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addAgeFiled(FormBuilderInterface $builder): void
    {
        $builder->add(
            static::FIELD_AGE, TextType::class,
            [
                'label' => 'Age',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addTypeFiled(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            static::FIELD_TYPE, ChoiceType::class,
            [
                'label' => 'Type',
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addLocationFiled(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            static::FIELD_LOCATION, ChoiceType::class,
            [
                'label' => 'Location',
                'choices' => array_flip([1 => 'Here', '2' => 'there']),
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }
}
