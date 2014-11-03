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
        $data = array();
        //        $parser = $this->get("barchart.parser");
        $analizer = $this->get("barchart.analizer");

        $analitic = new Analitic();
        $analitic->setName('Tester Analitique');
        $analitic->setEmail('smonkl@bk.ru');

        $signal = new Signal();
        $signal->setName('Test signal');
        $signal->setDirection($signal::DIRECTION_SELL);
        $signal->setIndicators(array(
            $signal::INDICATOR_OVERALL         => -100,
            $signal::INDICATOR_50_100_DAY_MACD => -1,
        ));

        $strategy = new Strategy();
        $strategy->setName('Test strategy');
        $strategy->setSignals(array($signal));
        $strategy->setAuthors(array($analitic));
        $strategy->setSymbol($strategy::SYMBOL_FOREX_GBPUSD);

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($analitic);
        $account->setBalance(1000);
        $account->setStrategy($strategy);

        $analizer->testStrategy($strategy);

        return $data;
    }
}
