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

    private $isStrategyNew;

    function __construct($isStrategyNew = false) {
        $this->isStrategyNew = $isStrategyNew;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->setMethod('POST');
        $builder->add('name', 'text', [
            'label'    => 'Название стратегии',
            'required' => true,
            'attr'     => [
                'placeholder' => 'Название стратегии',
            ]
        ]);
        $builder->add('symbol', 'choice', [
            'label'    => 'Торговый инструмент',
            'required' => true,
            'choices'  => Symbol::getSymbolName(),
        ]);
        $builder->add('addSignal', 'button', ['label' => 'Добавить сигнал']);
        $builder->add('signals', 'collection', [
            'label'        => false,
            'type'         => new SignalType(),
            'allow_add'    => true,
            'allow_delete' => true,
        ]);
        $builder->add('openIfExist', 'checkbox', [
            'label'    => 'Открывать ли параллельные сделки? (если уже есть открытые)',
            'required' => false,
        ]);
        $builder->add('isPrivate', 'checkbox', [
            'label'    => 'Видна только мне',
            'required' => false,
        ]);
        $builder->add('save', 'submit', [
            'label' => $this->isStrategyNew
                ? 'Создать стратегию'
                : 'Сохранить стратегию'
        ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
            'empty_data' => new Strategy(),
            'data_class' => 'Rottenwood\BarchartBundle\Entity\Strategy',
        ]);
    }

    public function getName() {
        return 'strategy';
    }
} 