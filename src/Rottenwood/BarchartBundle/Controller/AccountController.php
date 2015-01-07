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
     * @Route("/list", name="account.list")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAccountsAction() {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('RottenwoodBarchartBundle:TradeAccount')->findByAnalitic($this->getUser());

        if (!$accounts) {
            return $this->redirect($this->generateUrl('account.create'));
        }

        return ['accounts' => $accounts];
    }

    /**
     * Страница редактирования торгового аккаунта
     * @Route("/edit/{id}", requirements={"id"="\d+"}, name="account.edit")
     * @Template()
     * @ParamConverter("id", class="RottenwoodBarchartBundle:TradeAccount")
     * @param Request      $request
     * @param TradeAccount $account
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAccountAction(Request $request, TradeAccount $account) {
        if ($account->getAnalitic() !== $this->getUser()) {
            return $this->redirectToRoute('index');
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm(new ChangeStrategyType($em, $this->getUser(), ($user === $account->getAnalitic())),
            $account);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('account.info', [
                'id' => $account->getId(),
            ]);
        }

        return [
            'account' => $account,
            'form'    => $form->createView(),
        ];
    }

    /**
     * Страница торгового аккаунта
     * @Route("/{id}", requirements={"id"="\d+"}, name="account.info")
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
            return $this->redirectToRoute('account.list');
        }

        return [
            'account' => $account,
            'form'    => $form->createView(),
        ];
    }

    /**
     * @Route("/create", name="account.create")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAccountAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $strategies = $em->getRepository('RottenwoodBarchartBundle:Strategy')->findByAuthor($this->getUser());

        if (!$strategies) {
            return $this->redirect($this->generateUrl('strategy.create'));
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

            return $this->redirectToRoute('account.info',
                ['id' => $tradeAccount->getId()]
            );
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
