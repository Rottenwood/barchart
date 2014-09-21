<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 2:58
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\Entity\Price;

/**
 * Сервис анализа данных технических индикаторов
 * @package Rottenwood\BarchartBundle\Service
 */
class AnalizerService {

    private $em;
    private $config;
    private $high = 0;
    private $highId = 0;
    private $low = 0;
    private $lowId = 0;

    public function __construct(ConfigService $configService, EntityManager $em) {
        $this->em = $em;
        $this->config = $configService->getConfig();
    }

    public function analyseOverallCorn() {
        $corns = $this->em->getRepository('RottenwoodBarchartBundle:Corn')->findAll();

        foreach ($corns as $corn) {
            $cornPrice = $corn->getPrice();
            $cornOverall = $corn->getOverall();
            var_dump($cornOverall);

            // Удаление первой цены
            array_shift($corns);

            // Разница сравниваемой цены с последующими
            foreach ($corns as $cornToCheck) {
//                $cornPriceCheck = $cornToCheck->getPrice();
//                $priceDiff = $cornPrice - $cornPriceCheck;
//                echo $priceDiff, '..';

                var_dump($this->analyseProfit($corn, $cornToCheck, 'buy'));

            }
            var_dump('***************');
        }

        return $this;
    }

    /**
     * Расчет результата торговой позиции
     * @param Price  $priceObject
     * @param Price  $priceCompareObject
     * @param string $direction
     * @return array
     */
    protected function analyseProfit($priceObject, $priceCompareObject, $direction) {
        $return = array();

        $openPrice = $priceObject->getPrice();
        $closePrice = $priceCompareObject->getPrice();

        //        if ($direction == 'buy') {}
        $profit = $closePrice - $openPrice;

        if ($this->high < $profit) {
            $this->high = $profit;
            $this->highId = $priceCompareObject->getId();
        }

        if ($this->low > $profit) {
            $this->low = $profit;
            $this->lowId = $priceCompareObject->getId();
        }

        $timePassed = $priceCompareObject->getUnixtime() - $priceObject->getUnixtime();

        $return['profit'] = $profit;
        $return['open'] = $openPrice;
        $return['close'] = $closePrice;
        $return['highProfit'] = $this->high;
        $return['highProfitObjectId'] = $this->highId;
        $return['lowProfit'] = $this->low;
        $return['lowProfitObjectId'] = $this->lowId;
        $return['timePassed'] = $timePassed;
        $return['openObjectId'] = $priceObject->getId();
        $return['closeObjectId'] = $priceCompareObject->getId();

        return $return;
    }
}