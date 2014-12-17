<?php
/**
 * Author: Rottenwood
 * Date Created: 17.12.14 10:57
 */

namespace Rottenwood\BarchartBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccountController
 * @package Rottenwood\BarchartBundle\Controller
 * @Route("/account")
 */
class AccountController extends Controller {

    /**
     * @Route("/create")
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeAccountAction(Request $request) {

        return [];
    }
}