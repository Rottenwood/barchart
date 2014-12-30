<?php
/**
 * Author: Rottenwood
 * Date Created: 17.12.14 11:19
 */

namespace Rottenwood\BarchartBundle\Form;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\Entity\Analitic;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TradeAccountType extends AbstractType {

    private $analitic;
    /** @var EntityManager $em */
    private $em;

    function __construct(EntityManager $em, Analitic $analitic) {
        $this->em = $em;
        $this->analitic = $analitic;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', [
            'label'    => 'Название торгового счета',
            'required' => true,
        ]);
        $builder->add('balance', 'choice', [
            'label'       => 'Баланс на счету',
            'required'    => true,
            'choice_list' => new ChoiceList([
                                                100,
                                                1000
                                            ], [
                                                '100$',
                                                '1000$'
                                            ]),
        ]);
        $builder->add('strategy', 'entity', [
            'label'         => 'Стратегия',
            'required'      => false,
            'empty_value'   => 'выберите стратегию',
            'class'         => 'RottenwoodBarchartBundle:Strategy',
            'query_builder' => function ($repository) {
                return $repository->createQueryBuilder('s')
                                  ->where('s.author = :author')
                                  ->setParameter('author', $this->analitic)
                                  ->orderBy('s.name', 'ASC');
            }
        ]);
        $builder->add('isPrivate', 'checkbox', [
            'label'    => 'В закрытом доступе',
            'required' => false,
        ]);
        $builder->add('send', 'submit', ['label' => 'Создать торговый счет']);
        $builder->add('save', 'submit', ['label' => 'Сохранить торговый счет']);
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