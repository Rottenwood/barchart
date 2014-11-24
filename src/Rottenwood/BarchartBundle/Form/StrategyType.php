<?php
/**
 * Author: Rottenwood
 * Date Created: 10.11.14 11:06
 */

namespace Rottenwood\BarchartBundle\Form;

use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\Symbol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StrategyType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->setMethod('POST');
        $builder->add('name', 'text', array(
            'label' => 'Название стратегии',
            'required' => true,
            'attr' => array(
                'placeholder' => 'Название стратегии',
            )
        ));
        $builder->add('symbol', 'choice', array(
            'label' => 'Торговый инструмент',
            'required' => true,
            'choices' => Symbol::getSymbolName(),
        ));
        $builder->add('addSignal', 'button', array('label' => 'Добавить сигнал'));
        $builder->add('signals', 'collection', array(
            'label' => false,
            'type' => new SignalType(),
            'allow_add' => true,
            'allow_delete' => true,
        ));
        $builder->add('send', 'submit', array('label' => 'Проверить стратегию'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                                   'empty_data' => new Strategy(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\Strategy',
                               ));
    }

    public function getName() {
        return 'strategy';
    }
} 