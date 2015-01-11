<?php
/**
 * Author: Rottenwood
 * Date Created: 31.12.14 10:54
 */

namespace Rottenwood\BarchartBundle\Controller;

use Rottenwood\BarchartBundle\Entity\Analitic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Analitic Controller
 * @package Rottenwood\BarchartBundle\Controller
 * @Route("/analitic")
 */
class AnaliticController extends Controller {

    /**
     * @Route("/{id}", requirements={"id"="\d+"}, name="analitic.show")
     * @Template()
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAnaliticAction($id) {
        $em = $this->getDoctrine()->getManager();

        return [
            'analitic' => $em->getRepository('RottenwoodBarchartBundle:Analitic')->find($id),
        ];
    }

    /**
     * @Route("/", name="analitic.cabinet")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cabinetAction() {
        return ['analitic' => $this->getUser()];
    }
}
