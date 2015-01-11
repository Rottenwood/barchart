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
     * Личный кабинет и Страница аналитика
     * @Route("", name="analitic.cabinet")
     * @Route("/")
     * @Route("/{id}", requirements={"id"="\d+"}, name="analitic.sshow")
     * @Template()
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAnaliticAction($id = 0) {
        $em = $this->getDoctrine()->getManager();

        $twigParameters = [];

        if (!$id) {
        	$id = $this->getUser();
            $twigParameters['itIsCabinet'] = true;
        }

        $analitic = $em->getRepository('RottenwoodBarchartBundle:Analitic')->find($id);
        /** @var ArrayCollection $strategies */
        $strategies = $analitic->getStrategies();

        $criteria = Criteria::create()->where(Criteria::expr()->eq("isPrivate", false));

        $twigParameters['analitic'] = $analitic;
        $twigParameters['strategies'] = $strategies;
        $twigParameters['openStrategies'] = $strategies->matching($criteria);

        return $twigParameters;
    }
}
