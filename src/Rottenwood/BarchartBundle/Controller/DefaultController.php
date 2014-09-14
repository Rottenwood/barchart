<?php

namespace Rottenwood\BarchartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $data = array();
        $parser = $this->get("barchart.parser");

//        $parser->saveAllFutures();

        // Переформирование БД

        $symbols = $this->getDoctrine()->getRepository('RottenwoodBarchartBundle:CrudeOil')->findAll();

        foreach ($symbols as $symbolEntity) {

            $symbolEntity->setPrice($this->goodify($symbolEntity->getPrice()));
            $symbolEntity->setHigh($this->goodify($symbolEntity->getHigh()));
            $symbolEntity->setLow($this->goodify($symbolEntity->getLow()));
            $symbolEntity->setOpen($this->goodify($symbolEntity->getOpen()));
            $symbolEntity->setClose($this->goodify($symbolEntity->getClose()));
            $symbolEntity->setFivetwoweekhigh($this->goodify($symbolEntity->getFivetwoweekhigh()));
            $symbolEntity->setFivetwoweeklow($this->goodify($symbolEntity->getFivetwoweeklow()));
            $symbolEntity->setVolume($this->goodify($symbolEntity->getVolume()));
            $symbolEntity->setOpeninterest($this->goodify($symbolEntity->getOpeninterest()));
            $symbolEntity->setWeightedalpha($this->antiPlus($symbolEntity->getWeightedalpha()));
            $symbolEntity->setStandartdev($this->antiPlus($symbolEntity->getStandartdev()));
            $symbolEntity->setTwentydaverage($this->goodify($symbolEntity->getTwentydaverage()));
            $symbolEntity->setHundreddaverage($this->goodify($symbolEntity->getHundreddaverage()));
            $symbolEntity->setFourteendrelstrength($this->goodify($symbolEntity->getFourteendrelstrength()));
            $symbolEntity->setFourteendstochastic($this->goodify($symbolEntity->getFourteendstochastic()));
            $symbolEntity->setTrend($this->buySellToInt($symbolEntity->getTrend()));

            // индикаторы
            $symbolEntity->setAd($this->buySellToInt($symbolEntity->getAd()));
            $symbolEntity->setBollinger($this->buySellToInt($symbolEntity->getBollinger()));
            $symbolEntity->setLCci($this->buySellToInt($symbolEntity->getLCci()));
            $symbolEntity->setLMacd($this->buySellToInt($symbolEntity->getLMacd()));
            $symbolEntity->setLMavp($this->buySellToInt($symbolEntity->getLMavp()));
            $symbolEntity->setMCci($this->buySellToInt($symbolEntity->getMCci()));
            $symbolEntity->setMMacd($this->buySellToInt($symbolEntity->getMMacd()));
            $symbolEntity->setMMavp($this->buySellToInt($symbolEntity->getMMavp()));
            $symbolEntity->setMahilo($this->buySellToInt($symbolEntity->getMahilo()));
            $symbolEntity->setParabolic($this->buySellToInt($symbolEntity->getParabolic()));
            $symbolEntity->setSMacd($this->buySellToInt($symbolEntity->getSMacd()));
            $symbolEntity->setSMavp($this->buySellToInt($symbolEntity->getSMavp()));
            $symbolEntity->setTrendspotter($this->buySellToInt($symbolEntity->getTrendspotter()));
            $symbolEntity->setSAverage($this->buySellProcToInt($symbolEntity->getSAverage()));
            $symbolEntity->setMAverage($this->buySellProcToInt($symbolEntity->getMAverage()));
            $symbolEntity->setLAverage($this->buySellProcToInt($symbolEntity->getLAverage()));
            $symbolEntity->setOverall($this->buySellProcToInt($symbolEntity->getOverall()));

            $this->getDoctrine()->getManager()->persist($symbolEntity);

            echo $symbolEntity->getId(), ', ';
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->render('RottenwoodBarchartBundle:Default:index.html.twig', $data);
    }

    public function goodify($price) {
        $price = preg_replace('/(%)/', '', $price);
        $price = preg_replace('/(,)/', '', $price);
        $price = preg_replace('/(s)/', '', $price);
        if (preg_match('/([-.])/', $price)) {
            $priceInt = preg_replace('/([-.])(.*)/', '', $price);
            $priceFloat = preg_replace('/(.*)([-.])/', '', $price);
            $price = $priceInt . '.' . $priceFloat;
        }

        return (float)$price;
    }

    public function antiPlus($value) {
        if (preg_match('/([+])/', $value)) {
            $value = preg_replace('/([+])/', '', $value);
        }

        return (float)$value;
    }

    public function buySellToInt($value) {
        switch ($value) {
            default:
                // Добавить сюда логирование иного сигнала
                $indicatorDirection = 0;
                break;
            case 'Buy':
                $indicatorDirection = 1;
                break;
            case 'Sell':
                $indicatorDirection = -1;
                break;
            case 'Hold':
                $indicatorDirection = 0;
                break;
        }

        return $indicatorDirection;
    }

    public function buySellProcToInt($value) {
        $buySell = preg_replace('/(.*)(\s)/', '', $value);

        $indicatorDirection = $this->buySellToInt($buySell);

        if ($indicatorDirection) {
            $indicatorStrengthProc = preg_replace('/%(\s)(.*)/', '', $value);
        } else {
            $indicatorStrengthProc = 0;
        }

        $indicatorValueInt = $indicatorStrengthProc * $indicatorDirection;

        return (int)$indicatorValueInt;
    }
}
