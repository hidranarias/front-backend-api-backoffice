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
    protected const BLOCK_PREFIX = 'antelope';

    public function getBlockPrefix(): string
    {
        parent::getBlockPrefix();
        return static::BLOCK_PREFIX;
    }


    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->addNameField($builder);
        $this->addColorField($builder);
        $this->addGenderField($builder);
        $this->addWeightField($builder);
        $this->addAgeField($builder);
        $this->addTypeField($builder, $options);
        $this->addLocationField($builder, $options);
    }

    private function addNameField(FormBuilderInterface $builder): void
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

    private function addColorField(FormBuilderInterface $builder): void
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

    private function addGenderField(FormBuilderInterface $builder): void
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

    private function addWeightField(FormBuilderInterface $builder): void
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

    private function addAgeField(FormBuilderInterface $builder): void
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

    private function addTypeField(FormBuilderInterface $builder, array $options): void
    {
        $choices = ['Select' => ''];
        $choices += !empty($options['data']['locations']) ? $options['data']['locations'] : [];
        $builder->add(
            static::FIELD_TYPE, ChoiceType::class,
            [
                'label' => 'Type',
                'choices' => $choices,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }

    private function addLocationField(FormBuilderInterface $builder, array $options): void
    {
        $choices = ['Select' => ''];
        $choices += !empty($options['data']['locations']) ? $options['data']['locations'] : [];

        $builder->add(
            static::FIELD_LOCATION, ChoiceType::class,
            [
                'label' => 'Location',
                'choices' => $choices,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ]
        );
    }
}
