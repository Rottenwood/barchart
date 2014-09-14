<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 2:58
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Сервис анализа данных технических индикаторов
 * @package Rottenwood\BarchartBundle\Service
 */
class AnalizerService {
    private $em;
    private $kernel;

    public function __construct(ConfigService $configService, EntityManager $em, Kernel $kernel) {
        $this->em = $em;
        $this->kernel = $kernel;
    }

    public function analyseOverallCorn() {
        $corns = $this->em->getRepository('RottenwoodBarchartBundle:Corn')->findAll();

        foreach ($corns as $corn) {
            $cornPrice = $corn->getPrice();
            $cornOverall = $corn->getOverall();
            var_dump($cornOverall);
            foreach ($corns as $cornToCheck) {
                $cornPriceCheck = $cornToCheck->getPrice();
                $priceDiff = $cornPrice - $cornPriceCheck;
                echo $priceDiff, '..';
            }
            var_dump('***************');
        }

        return true;
    }
}