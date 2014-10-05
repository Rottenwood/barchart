<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");

        $parser->saveAllFutures();
        $parser->saveAllForex();

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
