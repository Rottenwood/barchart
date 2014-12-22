<?php

namespace Rottenwood\BarchartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
            'haveAccounts'   => count($em->getRepository('RottenwoodBarchartBundle:TradeAccount')
                                         ->findByAnalitic($user)) > 0,
        ];
    }

    /**
     * @Route("/strategy")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeStrategyAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $strategy = new Strategy();
        $strategy->setAuthor($this->getUser());

        $account = new TradeAccount();
        $account->setName('Test Account');
        $account->setAnalitic($this->getUser());
        $account->setBalance(1000);
        $account->setStrategy($strategy);

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
