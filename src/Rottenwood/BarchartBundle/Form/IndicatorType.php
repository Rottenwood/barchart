<?php
/**
 * Author: Rottenwood
 * Date Created: 13.11.14 11:42
 */

namespace Rottenwood\BarchartBundle\Form;

use Rottenwood\BarchartBundle\Entity\Indicator;
use Rottenwood\BarchartBundle\Entity\Signal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndicatorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'choice', [
            'label' => 'Индикатор',
            'required' => true,
            'choices' => Signal::getIndicatorsNames(),
        ]);
        $builder->add('value', 'integer', [
            'label' => 'Значение',
            'required' => true,
        ]);
        $builder->add('deleteIndicator', 'button', [
            'label' => 'Удалить индикатор',
            'attr' => ['class' => 'deleteIndicator'],
        ]);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
                                   'label' => false,
                                   'empty_data' => new Indicator(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\Indicator',
                               ]);
    }

    public function getName() {
        return 'indicator';
    }
} 