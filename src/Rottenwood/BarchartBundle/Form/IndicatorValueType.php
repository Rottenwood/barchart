<?php
/**
 * Author: Rottenwood
 * Date Created: 23.12.14 11:18
 */

namespace Rottenwood\BarchartBundle\Form;

use Doctrine\ORM\EntityRepository;
use Rottenwood\BarchartBundle\Entity\IndicatorValue;
use Rottenwood\BarchartBundle\Entity\Signal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndicatorValueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('indicator', 'entity', [
            'label'         => 'Индикатор',
            'required'      => true,
            'class'         => 'RottenwoodBarchartBundle:Indicator',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('i')->orderBy('i.name', 'ASC');
            },
        ]);
        $builder->add('value', 'choice', [
            'label'    => 'Значение',
            'required' => true,
            'choices'  => Signal::getDirectionsNames(),
        ]);
        $builder->add('deleteIndicator', 'button', [
            'label' => 'Удалить индикатор',
            'attr'  => ['class' => 'deleteIndicator'],
        ]);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
                                   'label'      => false,
                                   'empty_data' => new IndicatorValue(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\IndicatorValue',
                               ]);
    }

    public function getName() {
        return 'indicatorValue';
    }
} 