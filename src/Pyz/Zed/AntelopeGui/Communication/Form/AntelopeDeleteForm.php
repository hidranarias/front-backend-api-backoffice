<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Symfony\Component\Form\FormBuilderInterface;

class AntelopeDeleteForm extends AntelopeCreateForm
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        foreach ($builder->all() as $field) {
            $options = $field->getOptions();
            $options['attr'] = array_merge($options['attr'] ?? [], ['readonly' => true]);

            $builder->add($field->getName(), get_class($field->getType()->getInnerType()), $options);
        }
    }
}
