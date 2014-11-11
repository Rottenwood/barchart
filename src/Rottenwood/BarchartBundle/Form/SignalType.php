<?php
/**
 * Author: Rottenwood
 * Date Created: 10.11.14 11:06
 */

namespace Rottenwood\BarchartBundle\Form;

use Rottenwood\BarchartBundle\Entity\Signal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SignalType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array(
            'label' => 'Название сигнала',
            'required' => true,
            'attr' => array(
                'placeholder' => 'Название сигнала',
            )
        ));
        $builder->add('direction', 'choice', array(
            'label' => 'Направление открытия сделки',
            'required' => true,
            'choices' => Signal::getDirectionsNames(),
        ));
        $builder->add('stopLossPercent', 'integer', array(
            'label' => 'Стоп лосс при достижении просадки в % от цены',
            'attr' => array('max' => 100, 'min' => 0),
        ));
        $builder->add('takeProfitPercent', 'integer', array(
            'label' => 'Тейк профит при достижении прибыли в % от цены',
            'attr' => array('max' => 100, 'min' => 0),
        ));
        $builder->add('stopLoss', 'integer', array(
            'label' => 'Стоп лосс',
        ));
        $builder->add('takeProfit', 'integer', array(
            'label' => 'Тейк профит',
        ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
                                   'empty_data' => new Signal(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\Signal',
                               ));
    }

    public function getName() {
        return 'signal';
    }
} 