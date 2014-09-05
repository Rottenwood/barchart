<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();

        $service = $this->get("barchart.parser");

        var_dump($service->getPrice("ESU4"));

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
