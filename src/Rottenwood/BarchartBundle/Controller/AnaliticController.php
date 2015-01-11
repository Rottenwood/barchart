<?php
/**
 * Author: Rottenwood
 * Date Created: 31.12.14 10:54
 */

namespace Rottenwood\BarchartBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
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
     * @Route("", name="analitic.cabinet")
     * @Route("/")
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cabinetAction() {
        $em = $this->getDoctrine()->getManager();
        $analitic = $em->getRepository('RottenwoodBarchartBundle:Analitic')->find($this->getUser());
        /** @var ArrayCollection $strategies */
        $strategies = $analitic->getStrategies();

        $criteria = Criteria::create()->where(Criteria::expr()->eq("isPrivate", false));

        return [
            'analitic'       => $analitic,
            'strategies'     => $strategies,
            'openStrategies' => $strategies->matching($criteria),
        ];
    }

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
}
