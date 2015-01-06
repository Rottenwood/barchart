<?php
/**
 * Author: Rottenwood
 * Date Created: 17.12.14 10:57
 */

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\TradeAccount;
use Rottenwood\BarchartBundle\Form\ChangeStrategyType;
use Rottenwood\BarchartBundle\Form\TradeAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * Страница торгового аккаунта
     * @Route("/{id}", requirements={"id"="\d+"})
     * @Template()
     * @ParamConverter("id", class="RottenwoodBarchartBundle:TradeAccount")
     * @param Request      $request
     * @param TradeAccount $account
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAccountAction(Request $request, TradeAccount $account) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($account->isPrivate() && $account->getAnalitic() !== $this->getUser()) {
            return [
                'accountIsPrivate' => $account->getId(),
            ];
        }

        $form = $this->createForm(new ChangeStrategyType($em, $this->getUser(), ($user === $account->getAnalitic())),
            $account);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('rottenwood_barchart_account_listaccounts');
        }

        return [
            'account' => $account,
            'form'    => $form->createView(),
        ];
    }

    /**
     * @Route("/trades")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tradesAccountsAction() {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('RottenwoodBarchartBundle:TradeAccount')->findByAnalitic($this->getUser());

        if (!$accounts) {
            return $this->redirect($this->generateUrl('rottenwood_barchart_account_createaccount'));
        }

        $analizer = $this->get('barchart.analizer');

        $allTrades = [];
        foreach ($accounts as $account) {
            $allTrades[] = $analizer->testStrategy($account);
        }

        return [
            'accounts'  => $accounts,
            'allTrades' => $allTrades
        ];
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

        $form = $this->createForm(new TradeAccountType($em, $this->getUser()));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $tradeAccount = $form->getData();
            /** @var TradeAccount $tradeAccount */
            $tradeAccount->setEquity($tradeAccount->getBalance());
            $tradeAccount->setStartBalance($tradeAccount->getBalance());
            $tradeAccount->setAnalitic($this->getUser());

            $em->persist($tradeAccount);
            $em->flush();

            return $this->redirectToRoute('rottenwood_barchart_account_listaccounts');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
