<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");

        //***** FUTURES *****//

        // E-Mini SNP500
        $parser->savePrice("ESU4");

        // Soybeans
        $parser->savePrice("ZSX14");

        // DowJones Mini
        $parser->savePrice("YMU4");
        
        // Crude Oil
        $parser->savePrice("CLV4");
        
        // Natural Gas
        $parser->savePrice("NGV4");
        
        // Gold
        $parser->savePrice("GCZ4");
        
        // Silver
        $parser->savePrice("SIZ4");
        
        // Wheat
        $parser->savePrice("ZWZ4");
        
        // Corn
        $parser->savePrice("ZCZ4");
        
        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }
}
