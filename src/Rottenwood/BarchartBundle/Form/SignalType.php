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
        $builder->add('direction', 'choice', [
            'label'    => 'Направление открытия сделки',
            'required' => true,
            'choices'  => Signal::getDirectionsNames(),
        ]);
        $builder->add('indicatorValues', 'collection', [
            'label'        => false,
            'type'         => new IndicatorValueType(),
            'allow_add'    => true,
            'allow_delete' => true,
        ]);
        $builder->add('addIndicator', 'button', [
            'label' => 'Добавить индикатор',
            'attr'  => ['class' => 'addIndicator'],
        ]);
        $builder->add('stopLossPercent', 'integer', [
            'label'    => 'Стоп лосс при достижении просадки (в % от цены открытия)',
            'required' => false,
            'attr'     => [
                'max' => 100,
                'min' => 0
            ],
        ]);
        $builder->add('takeProfitPercent', 'integer', [
            'label'    => 'Тейк профит при достижении прибыли (в % от цены открытия)',
            'required' => false,
            'attr'     => [
                'max' => 100,
                'min' => 0
            ],
        ]);
        $builder->add('stopLoss', 'integer', [
            'label'    => 'Стоп лосс (в валюте депозита)',
            'required' => false,
        ]);
        $builder->add('takeProfit', 'integer', [
            'label'    => 'Тейк профит (в валюте депозита)',
            'required' => false,
        ]);
        $builder->add('deleteSignal', 'button', [
            'label' => 'Удалить сигнал',
            'attr'  => ['class' => 'deleteSignal'],
        ]);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
                                   'empty_data' => new Signal(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\Signal',
                               ]);
    }

    public function getName() {
        return 'signal';
    }
} 