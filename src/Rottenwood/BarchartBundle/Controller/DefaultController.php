<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");
        $analyser = $this->get("barchart.analizer");

//        $parser->saveAllFutures();

        $analyser->analyseOverallCorn();

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
