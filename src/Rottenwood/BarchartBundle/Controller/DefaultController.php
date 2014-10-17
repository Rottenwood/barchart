<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
//        $parser = $this->get("barchart.parser");
//        $analizer = $this->get("barchart.analizer");

        return array();
    }
}
