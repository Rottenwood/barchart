<?php
/**
 * Author: Rottenwood
 * Date Created: 17.12.14 11:19
 */

namespace Rottenwood\BarchartBundle\Form;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\DataTransformer\StrategyNameTransformer;
use Rottenwood\BarchartBundle\Entity\Analitic;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TradeAccountType extends AbstractType {

    private $analitic;
    /** @var EntityManager $em */
    private $em;

    function __construct(Analitic $analitic, EntityManager $em) {
        $this->analitic = $analitic;
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', [
            'label'    => 'Название торгового счета',
            'required' => true,
        ]);
        $builder->add('strategy', 'entity', [
            'label'         => 'Стратегия',
            'required'      => false,
            'empty_value'   => 'стратегия',
            'class'         => 'RottenwoodBarchartBundle:Strategy',
            'query_builder' => function ($repository) {
                return $repository->createQueryBuilder('s')
                                  ->where('s.author = :author')
                                  ->setParameter('author', $this->analitic)
                                  ->orderBy('s.name', 'ASC');
            }
        ]);
        $builder->add('send', 'submit', ['label' => 'Создать торговый счет']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
                                   'label'      => false,
                                   'empty_data' => new TradeAccount(),
                                   'data_class' => 'Rottenwood\BarchartBundle\Entity\TradeAccount',
                               ]);
    }

    public function getName() {
        return 'tradeAccount';
    }
} 