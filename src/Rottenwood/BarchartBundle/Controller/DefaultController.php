<?php

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Analitic;
use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        //                $analizer = $this->get("barchart.analizer");

        $analitic = new Analitic();
        $analitic->setName('Tester Analitique');
        $analitic->setEmail('smonkl@bk.ru');

        $signal = new Signal();
        $signal->setName('Test signal');
        $signal->setDirection(Signal::DIRECTION_SELL);
        $signal->setIndicators(array(
                                   Signal::INDICATOR_AVERAGE_SHORTTERM => Signal::SIGNAL_MAXIMUM_SELL,
                               ));
        $signal->setStopLossPercent(2);
        $signal->setTakeProfitPercent(7);

        $strategy = new Strategy();
        $strategy->setName('Test strategy');
        $strategy->setSignals(array($signal));
        $strategy->setAuthors(array($analitic));
        $strategy->setSymbol(Strategy::SYMBOL_FUTURES_CORN);

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($analitic);
        $account->setBalance(1000);
        $account->setStrategy($strategy);
        //
        //        return array(
        //            'trades' => $analizer->testStrategy($strategy),
        //        );

        $form = $this->createFormBuilder($strategy);
        $form->add('name', 'text', array(
            'required' => true,
            'attr' => array(
                'placeholder' => 'Название стратегии',
            )
        ));
        $form->add('send', 'submit', array('label' => 'Проверить стратегию'));
        $form = $form->getForm();

        return array(
            'form' => $form->createView(),
        );
    }
}
