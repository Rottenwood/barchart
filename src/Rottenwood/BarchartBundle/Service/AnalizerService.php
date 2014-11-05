<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 2:58
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\Entity\Price;
use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

/**
 * Сервис анализа данных технических индикаторов
 * @date    22.09.2014
 * @package Rottenwood\BarchartBundle\Service
 */
class AnalizerService {

    const AVERAGE_SHORTTERM = 1;
    const AVERAGE_MIDDLETERM = 2;
    const AVERAGE_LONGTERM = 3;
    const AVERAGE_OVERALL = 4;

    private $em;
    private $config;
    private $high = 0;
    private $highId = 0;
    private $low = 0;
    private $lowId = 0;
    private $lastProfit;
    private $tradeProfit = 0;

    public function __construct(ConfigService $configService, EntityManager $em) {
        $this->em = $em;
        $this->config = $configService->getConfig();
    }

//    /**
//     * Анализ (тестовый), находится в разработке
//     * Количество часов (полей) для запроса из БД
//     * В торговой неделе 5 дней, в торговом дне 19 часов
//     * @return $this
//     */
//    public function analyseOverallCorn() {
//        $profit = array();
//        $grossProfit = 0;
//        $drawdown = 0;
//        $drawdowns = 0;
//
//        $limit = $this->getLimit();
//        $limitTwice = $limit * 2;
//
//        // Получаем нужное количество объектов-цен
//        $corns = $this->em->getRepository('RottenwoodBarchartBundle:Corn')->findPricesFromId(1, $limitTwice);
//
//        // Обработка полученных цен
//        $cornsArray = $corns->toArray();
//        $cornsCount = $corns->count();
//
//        $i = 0;
//        foreach ($cornsArray as $key => $value) {
//            $priceToAnalize = $cornsArray[$i];
//
//            for ($x = $i; $x < ($limit + $i); $x++) {
//                $price = $cornsArray[$x];
//                $profit = $this->analyseProfit($priceToAnalize, $price);
//                if ($profit['lowProfit'] < -3) {
//                    $drawdowns++;
//                    break 2;
//                }
//            };
//            var_dump($profit);
//            //            $grossProfit = $grossProfit + $profit['highProfit'];
//            $grossProfit = $grossProfit + $profit['profit'];
//            $drawdown = $drawdown + $profit['lowProfit'];
//
//
//            if (++$i == $limit) {
//                break;
//            }
//        }
//
//        var_dump($grossProfit);
//        var_dump($drawdowns);
//
//        return $this;
//    }

    /**
     * Получение массива цен запрашиваемого инструмента
     * @param string $symbol    Название торгового символа
     * @param int    $priceFrom Запрос цен начиная с данного id
     * @param int    $bars      Запрашиваемое количество цен
     * @return array
     */
    public function getPrices($symbol, $priceFrom = 1, $bars = 0) {
        $symbolRepositoryName = "RottenwoodBarchartBundle:" . $symbol;

        // Если количество анализируемых цен не указано, берем их из конфига
        $bars = $bars ?: $this->getLimit();

        return $this->em->getRepository($symbolRepositoryName)->findPricesFromId($priceFrom, $bars);
    }

    /**
     * Запрос массива всех цен для заданного символа
     * @param $symbol
     * @return array
     */
    public function getAllPrices($symbol) {
        $symbolRepositoryName = "RottenwoodBarchartBundle:" . $symbol;

        return $this->em->getRepository($symbolRepositoryName)->findAll();
    }

    /**
     * Определение показаний индикатора по выбранной цене
     * @param Price  $price
     * @param string $indicator
     * @return mixed
     */
    public function indicator(Price $price, $indicator) {
        $indicatorName = 'get' . $indicator;

        return $price->$indicatorName();
    }

    /**
     * //TODO: нуждается в тестировании
     * Фильтрация последовательности цен, которые соответствуют серии одинаковых показателей индикатора
     * @param Price[] $prices
     * @param string  $indicator
     * @param int     $direction
     * @param int     $series
     * @return array
     */
    public function indicatorSeriesSignal($prices, $indicator, $direction, $series = 0) {
        $series = $series ?: $this->config['analizer']['series'];
        $indicatorName = 'get' . $indicator;

        $resultPrices = array();
        foreach ($prices as $key => $price) {
            $counter = 0;
            foreach (array_slice($prices, $key) as $priceForAnalize) {
                if ($priceForAnalize->$indicatorName() == $direction) {
                    $counter++;
                }
            }

            $resultPrices[] = ($counter != $series) ?: $price;
        }

        return $resultPrices;
    }

    /**
     * //TODO: нуждается в тестировании
     * Фильтрация массива цен на соответствие тренду
     * @param Price[] $prices
     * @param int     $trend
     * @return array
     */
    public function trendFilter($prices, $trend) {
        $resultPrices = array();
        foreach ($prices as $price) {
            /** @var Price $price */
            $resultPrices[] = ($price->getTrend() != $trend) ?: $price;
        }

        return $resultPrices;
    }

    /**
     * //TODO: нуждается в тестировании
     * Фильтрация массива цен на соответствие показателю усредненной группы индикаторов
     * @param Price[] $prices  Массив цен
     * @param int     $average 1 - shortTermAverage, 2 - middleTermAverage, 3 - longTermAverage, 4 - overall
     * @param int     $percent
     * @return array
     * @throws \Exception
     */
    public function averageFilter($prices, $average, $percent) {
        $averageIndicatorName = $this->getAverageFunctionName($average);

        if (!$averageIndicatorName) {
            throw new \Exception("Функция усреднения $average не найдена");
        }

        $resultPrices = array();
        foreach ($prices as $price) {
            $averageResult = $price->$averageIndicatorName();

            if ($percent >= 0 && $averageResult >= $percent || $percent < 0 && $averageResult < $percent) {
                $resultPrices[] = $price;
            }
        }

        return $resultPrices;
    }

    /**
     * //TODO: нуждается в тестировании
     * Фильтрация массива цен по заданному или среднему объему
     * @param Price[] $prices
     * @param int     $volume
     * @param bool    $lowerThan больше
     * @return array
     */
    public function volumeFilter($prices, $volume = 0, $lowerThan = false) {
        // Если не указан объем, расчет среднего объема для массива цен
        if (!$volume) {
            $volumeAverage = array();
            foreach ($prices as $priceObject) {
                $volumeAverage[] = $priceObject->getVolume();
            }

            $volume = array_sum($volumeAverage) / count($volumeAverage);
        }

        $resultPrices = array();
        foreach ($prices as $price) {
            if ($lowerThan) {
                if ($price->getVolume() <= $volume) {
                    $resultPrices[] = $price;
                }
            } else {
                if ($price->getVolume() >= $volume) {
                    $resultPrices[] = $price;
                }
            }
        }

        return $resultPrices;
    }

    // TODO: Рефакторинг!
    public function testStrategy(Strategy $strategy) {
        // Получение цен для анализа
        $prices = $this->getAllPrices($strategy->getSymbolName()[$strategy->getSymbol()]);

        var_dump('Price: ' . $prices[0]->getPrice());

        /** @var Price $price */
        foreach ($prices as $priceKey => $price) {
            // Сигналы
            foreach ($strategy->getSignals() as $signal) {
                $indicatorsPassed = 0;
                foreach ($signal->getIndicators() as $indicatorName => $indicatorValue) {
                    $indicatorMethod = 'get' . $signal->getIndicatorsMethodNames()[$indicatorName];

                    if (($price->$indicatorMethod() >= $indicatorValue && $signal->getDirection() ==
                            $signal::DIRECTION_BUY && $price->$indicatorMethod() != $signal::SIGNAL_HOLD)
                        || ($price->$indicatorMethod() <= $indicatorValue && $signal->getDirection() ==
                            $signal::DIRECTION_SELL && $price->$indicatorMethod() != $signal::SIGNAL_HOLD)
                        || ($indicatorValue == $price->$indicatorMethod() && $signal->getDirection() ==
                            $signal::SIGNAL_HOLD)
                    ) {
                        $indicatorsPassed++;
                    }
                }

                if ($indicatorsPassed == count($signal->getIndicators())) {
                    // Имитация открытия сделки, расчет ее результатов

                    // Сравнение цены открытия с последующими ценами
                    $tradeProfit = 0;
                    $high = 0;
                    $low = 0;

                    /** @var Price $comparePrice */
                    foreach (array_slice($prices, $priceKey + 1) as $comparePriceKey => $comparePrice) {
//                        if ($comparePriceKey >= 95) {
//                        	break;
//                        }

                        $profit = $this->analyseProfit($price, $comparePrice, $signal->getDirection());
                        $tradeProfit =+ $profit['profit'];

                        if ($profit['profit'] > $high) {
                            $high = $profit['profit'];
                        }

                        if ($profit['profit'] < $low) {
                            $low = $profit['profit'];
                        }

                        // Критерии закрытия сделки
                        $percentProfit = $profit['profit'] / $price->getPrice() * 100;

                        if ($signal->getStopLossPercent() && -$percentProfit > $signal->getStopLossPercent()) {
                            var_dump('STOP');
                            echo '<br><br>';
                            break;
                        }

                        if ($signal->getTakeProfitPercent() && $percentProfit > $signal->getTakeProfitPercent()) {
                            var_dump('TAKE');
                            echo '<br><br>';
                            break;
                        }
                    }

                    var_dump('High: ' . $high);
                    var_dump('Low: ' . $low);
                    var_dump('Profit: ' . $tradeProfit);
                }

            }
        }
    }

    /**
     * Получение имен для усредненных групп индикаторов
     * @return array
     */
    public function getAverageNames() {
        return array(
            self::AVERAGE_SHORTTERM  => 'Средний показатель краткосрочных индикаторов',
            self::AVERAGE_MIDDLETERM => 'Средний показатель среднесрочных индикаторов',
            self::AVERAGE_LONGTERM   => 'Средний показатель долгосрочных индикаторов',
            self::AVERAGE_OVERALL    => 'Средний показатель всех индикаторов',
        );
    }

    /**
     * Получение имени геттера для усредненных групп индикаторов
     * @param integer $average
     * @return array
     */
    private function getAverageFunctionName($average) {
        $averageFunctionNames = array(
            self::AVERAGE_SHORTTERM  => 'getShorttermAverage',
            self::AVERAGE_MIDDLETERM => 'getMiddletermAverage',
            self::AVERAGE_LONGTERM   => 'getLongtermAverage',
            self::AVERAGE_OVERALL    => 'getOverall',
        );

        return $averageFunctionNames[$average];
    }

    /**
     * Расчет результата торговой позиции
     * @param Price $priceObject
     * @param Price $priceCompareObject
     * @param int   $direction
     * @return array
     */
    private function analyseProfit(Price $priceObject, Price $priceCompareObject, $direction) {
        $return = array();

        $openPrice = $priceObject->getPrice();
        $closePrice = $priceCompareObject->getPrice();

        if ($direction == Signal::DIRECTION_BUY) {
            $profit = $closePrice - $openPrice;
        } elseif ($direction == Signal::DIRECTION_SELL) {
            $profit = $openPrice - $closePrice;
        } else {
            // Если сигнал к удержанию позиции
            return $return['hold'];
        }

        // Сохранение значения для дальнейшего использования
        $this->lastProfit = $profit;

//        if ($profit > $this->high) {
//            $this->high = $profit;
//            $this->highId = $priceCompareObject->getId();
//        }
//
//        if ($profit < $this->low) {
//            $this->low = $profit;
//            $this->lowId = $priceCompareObject->getId();
//        }

        $timePassed = $priceCompareObject->getDate()->getTimestamp() - $priceObject->getDate()->getTimestamp();

        $return['profit'] = $profit;
        $return['open'] = $openPrice;
        $return['close'] = $closePrice;
        $return['highProfit'] = $this->high;
        //                $return['highProfitObject'] = $this->highId;
        $return['lowProfit'] = $this->low;
        //        $return['lowProfitObject'] = $this->lowId;
        $return['timePassed'] = $timePassed;
        $return['openObject'] = $priceObject->getId();
        $return['closeObject'] = $priceCompareObject->getId();

        return $return;
    }

    /**
     * Определение горизонта для анализа
     * @return integer
     */
    private function getLimit() {
        $limitWeeks = $this->config['analizer']['horizon']['weeks'];
        $limitDays = $this->config['analizer']['horizon']['days'];
        $limitHours = $this->config['analizer']['horizon']['hours'];

        return $limitWeeks * 5 * 19 + $limitDays * 19 + $limitHours;
    }

}