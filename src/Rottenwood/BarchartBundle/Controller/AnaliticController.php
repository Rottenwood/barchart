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
     * @Route("/", defaults={"id"=0})
     * @Route("/{id}", requirements={"id"="\d+"})
     * @Template()
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id) {
        $em = $this->getDoctrine()->getManager();
        $analitic = $em->getRepository('RottenwoodBarchartBundle:Analitic')->find($id);

        return $analitic ? ['analitic' => $analitic] : [];
    }
}
