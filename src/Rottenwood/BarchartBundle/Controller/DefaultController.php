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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/barchart")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

<<<<<<< HEAD
=======
//        $analitic = new Analitic();
//        $analitic->setName('Tester Analitique');
//        $analitic->setEmail('smonkl@bk.ru');

>>>>>>> 05e6bda8337626f1a8c613a7bdf54daf1f0005d8
        $signal = new Signal();
        $signal->setName('Test signal');
        $signal->setDirection(Signal::DIRECTION_SELL);
        $signal->setIndicators([
                                   new Indicator(),
                                   new Indicator(),
                               ]);
        $signal->setStopLossPercent(2);
        $signal->setTakeProfitPercent(7);

        $strategy = new Strategy();
        $strategy->setName('Test strategy');
        $strategy->setSignals([$signal]);
        $strategy->setAuthors([$this->getUser()]);
        $strategy->setSymbol(Strategy::SYMBOL_FUTURES_CORN);

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($this->getUser());
        $account->setBalance(1000);
        $account->setStrategy($strategy);

        $form = $this->createForm(new StrategyType(), $strategy);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $strategy = $form->getData();

            $em->persist($strategy);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
