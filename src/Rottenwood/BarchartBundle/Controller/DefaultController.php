<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");
        $analizer = $this->get("barchart.analizer");

        $parser->saveAllFutures();

//        $analizer->analyseOverallCorn();

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
