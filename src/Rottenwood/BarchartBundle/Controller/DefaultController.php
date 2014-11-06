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
        //        $parser = $this->get("barchart.parser");
        $analizer = $this->get("barchart.analizer");

        $analitic = new Analitic();
        $analitic->setName('Tester Analitique');
        $analitic->setEmail('smonkl@bk.ru');

        $signal = new Signal();
        $signal->setName('Test signal');
        $signal->setDirection(Signal::DIRECTION_BUY);
        $signal->setIndicators(array(
            Signal::INDICATOR_OVERALL         => 100,
//            Signal::INDICATOR_50_100_DAY_MACD => Signal::SIGNAL_BUY,
        ));
        $signal->setStopLossPercent(0.05);
        $signal->setTakeProfitPercent(0.05);

        $strategy = new Strategy();
        $strategy->setName('Test strategy');
        $strategy->setSignals(array($signal));
        $strategy->setAuthors(array($analitic));
//        $strategy->setSymbol(Strategy::SYMBOL_FUTURES_NATURALGAS);
        $strategy->setSymbol(Strategy::SYMBOL_FOREX_USDJPY);

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($analitic);
        $account->setBalance(1000);
        $account->setStrategy($strategy);

        return array(
            'trades' => $analizer->testStrategy($strategy),
        );
    }
}
