<?php

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Analitic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Rottenwood\BarchartBundle\Form\StrategyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/")
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
     * @Route("/strategy/create")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeStrategyAction(Request $request) {
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

            return $this->redirectToRoute('rottenwood_barchart_account_createaccount');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Список стратегий
     * @Route("/strategy/list")
     * @Template()
     * @return array
     */
    public function listStrategiesAction() {
        $em = $this->getDoctrine()->getManager();

        return [
            'strategies' => $em->getRepository('RottenwoodBarchartBundle:Strategy')->findByAuthor($this->getUser()),
        ];
    }

    /**
     * Редактирование стратегий
     * @Route("/strategy/edit/{id}", requirements={"id"="\d+"})
     * @Template("RottenwoodBarchartBundle:Default:makeStrategy.html.twig")
     * @ParamConverter("id", class="RottenwoodBarchartBundle:Strategy")
     * @param Request  $request
     * @param Strategy $strategy
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function strategyEditAction(Request $request, Strategy $strategy) {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new StrategyType(), $strategy, ['cascade_validation' => true]);
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
