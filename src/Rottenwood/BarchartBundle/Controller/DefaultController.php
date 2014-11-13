<?php

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Analitic;
use Rottenwood\BarchartBundle\Entity\Indicator;
use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Rottenwood\BarchartBundle\Form\StrategyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        $analitic = new Analitic();
        $analitic->setName('Tester Analitique');
        $analitic->setEmail('smonkl@bk.ru');

        $signal = new Signal();
        $signal->setName('Test signal');
        $signal->setDirection(Signal::DIRECTION_SELL);
        $signal->setIndicators(array(new Indicator(),
//                                   Signal::INDICATOR_AVERAGE_SHORTTERM => Signal::SIGNAL_MAXIMUM_SELL,
//                                   Signal::INDICATOR_AVERAGE_SHORTTERM,
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

        $form = $this->createForm(new StrategyType(), $strategy);
        $form->handleRequest($request);

        return array(
            'form' => $form->createView(),
        );
    }
}
