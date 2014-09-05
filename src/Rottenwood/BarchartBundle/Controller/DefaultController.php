<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");

        // ESU4 : E-Mini SNP500
        // ZSX14 : Soybeans (september 14)
//        var_dump($parser->getPrice("ZSX14"));

        $parser->savePrice("ESU4");

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
