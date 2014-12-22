<?php
/**
 * Author: Rottenwood
 * Date Created: 17.12.14 10:57
 */

namespace Rottenwood\BarchartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Rottenwood\BarchartBundle\Form\TradeAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccountController
 * @package Rottenwood\BarchartBundle\Controller
 * @Route("/account")
 */
class AccountController extends Controller {

    /**
     * @Route("/list")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAccountsAction() {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('RottenwoodBarchartBundle:TradeAccount')->findByAnalitic($this->getUser());

        if (!$accounts) {
        	return $this->redirect($this->generateUrl('rottenwood_barchart_account_createaccount'));
        }

        return ['accounts' => $accounts];
    }

    /**
     * @Route("/create")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAccountAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $strategies = $em->getRepository('RottenwoodBarchartBundle:Strategy')->findByAuthor($this->getUser());

        if (!$strategies) {
            return $this->redirect($this->generateUrl('rottenwood_barchart_default_makestrategy'));
        }

        $form = $this->createForm(new TradeAccountType($this->getUser(), $em));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $tradeAccount = $form->getData();

            $em->persist($tradeAccount);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
