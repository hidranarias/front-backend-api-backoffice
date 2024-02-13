<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
    public const ANTELOPE_LOCATIONS = 'locations';
    public const ANTELOPE_TYPES = 'types';

    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix(): string
    {
        parent::getBlockPrefix();
        return static::BLOCK_PREFIX;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([static::ANTELOPE_LOCATIONS => [], static::ANTELOPE_TYPES => []]);
        parent::configureOptions($resolver);
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        parent::buildForm($builder, $options);
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
        $choices += !empty($options[static::ANTELOPE_LOCATIONS]) ? $options[static::ANTELOPE_LOCATIONS] : [];
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
        $choices += !empty($options[static::ANTELOPE_TYPES]) ? $options[static::ANTELOPE_TYPES] : [];

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
