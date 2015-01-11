<?php

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Form\StrategyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DefaultController extends Controller {

    /**
     * @Route("/", name="index")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        return [
            'haveStrategies' => count($em->getRepository('RottenwoodBarchartBundle:Strategy')->findByAuthor($user)) > 0,
            'haveAccounts'   =>
                count($em->getRepository('RottenwoodBarchartBundle:TradeAccount')->findByAnalitic($user)) > 0,
        ];
    }

    /**
     * @Route("/strategy/create", name="strategy.create")
     * @Template("RottenwoodBarchartBundle:Default:editStrategy.html.twig")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createStrategyAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $strategy = new Strategy();
        $strategy->setAuthor($this->getUser());

        $isStrategyNew = true;

        $form = $this->createForm(new StrategyType($isStrategyNew), $strategy, ['cascade_validation' => true]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $strategy = $form->getData();

            $em->persist($strategy);
            $em->flush();

            return $this->redirectToRoute('account.create');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Список стратегий
     * @Route("/strategy/list", name="strategy.list")
     * @Template()
     * @return array
     */
    public function listStrategiesAction() {
        $em = $this->getDoctrine()->getManager();
        $strategies = $em->getRepository('RottenwoodBarchartBundle:Strategy')->findByAuthor($this->getUser());

        if (!$strategies) {
            return $this->redirectToRoute('index');
        }

        return [
            'strategies' => $strategies,
        ];
    }

    /**
     * Редактирование стратегий
     * @Route("/strategy/edit/{id}", requirements={"id"="\d+"}, name="strategy.edit")
     * @Template()
     * @ParamConverter("id", class="RottenwoodBarchartBundle:Strategy")
     * @param Request  $request
     * @param Strategy $strategy
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editStrategyAction(Request $request, Strategy $strategy) {

        if ($this->getUser()->getId() != $strategy->getAuthor()->getId()) {
            return $this->redirectToRoute('strategy.list');
        }

        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new StrategyType(), $strategy, ['cascade_validation' => true]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $strategy = $form->getData();

            $em->persist($strategy);
            $em->flush();

            return $this->redirectToRoute('strategy.list');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Бэктестинг стратегии
     * @Route("/test/{id}", requirements={"id"="\d+"}, name="strategy.test")
     * @Template()
     * @ParamConverter("id", class="RottenwoodBarchartBundle:Strategy")
     * @param Strategy $strategy
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testStrategyAction(Strategy $strategy) {
        if ($strategy->isPrivate() && $strategy->getAuthor() !== $this->getUser()) {
            return [
                'strategyIsPrivate' => $strategy->getId(),
            ];
        }

        $analizer = $this->get('barchart.analizer');
        $trades = $analizer->testStrategy($strategy);

        return [
            'strategy'       => $strategy,
            'trades'         => $trades,
            'percentProfit'  => $analizer->calculatePercentProfit($trades),
            'firstPriceDate' => $analizer->getFirstPriceDate($strategy),
            'lastPriceDate'  => $analizer->getLastPriceDate($strategy),
        ];
    }
}
