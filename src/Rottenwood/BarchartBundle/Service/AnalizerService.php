<?php
/**
 * Author: Rottenwood
 * Date Created: 13.09.14 2:58
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\Entity\IndicatorValue;
use Rottenwood\BarchartBundle\Entity\Price;
use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;
use Rottenwood\BarchartBundle\Entity\Trade;
use Symfony\Component\Routing\Exception\InvalidParameterException;

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
    private $hasOpenedTrades = false;

    public function __construct(ConfigService $configService, EntityManager $em) {
        $this->em = $em;
        $this->config = $configService->getConfig();
    }

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

        $resultPrices = [];
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
        $resultPrices = [];
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
            throw new \Exception('Функция усреднения ' . $average . ' не найдена');
        }

        $resultPrices = [];
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
            $volumeAverage = [];
            foreach ($prices as $priceObject) {
                $volumeAverage[] = $priceObject->getVolume();
            }

            $volume = array_sum($volumeAverage) / count($volumeAverage);
        }

        $resultPrices = [];
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

    /**
     * Бэктестинг стратеги
     * @param Strategy $strategy
     * @param int      $volume
     * @return array
     */
    public function testStrategy(Strategy $strategy, $volume = 1) {
        // Получение цен для анализа
        $prices = $this->getAllPrices($strategy->getSymbolName()[$strategy->getSymbol()]);
        $trades = [];

        /** @var Price $priceObject */
        foreach ($prices as $priceKey => $priceObject) {
            $price = $priceObject->getPrice();

            // Закрытие сделок
            /** @var Trade $openedTrade */
            foreach ($trades as $openedTrade) {
                if ($openedTrade->getClose()) {
                    continue;
                }

                /** @var Signal $openedTradeSignal */
                $openedTradeSignal = $openedTrade->getSignal();
                $stopLoss = $openedTradeSignal->getStopLoss();
                $stopLossPercent = $openedTradeSignal->getStopLossPercent();
                $takeProfit = $openedTradeSignal->getTakeProfit();
                $takeProfitPercent = $openedTradeSignal->getTakeProfitPercent();
                $openedTradePrice = $openedTrade->getOpen();

                // Расчет прибыли
                if ($openedTrade->getDirection() == $openedTrade::DIRECTION_BUY) {
                    $profit = $openedTradePrice - $price;
                } elseif ($openedTrade->getDirection() == $openedTrade::DIRECTION_SELL) {
                    $profit = $price - $openedTradePrice;
                } else {
                    throw new InvalidParameterException($openedTrade->getDirection());
                }

                // Прибыль в процентах
                $percentProfit = $profit / $openedTradePrice * 100;

                // Стоп в пунктах
                if ($stopLoss && -$stopLoss >= $profit) {
                    $this->closeTrade($openedTrade, $price, $priceObject->getDate(), $stopLoss);
                } // Стоп в процентах
                elseif ($stopLossPercent && -$stopLossPercent >= $percentProfit) {
                    $this->closeTrade($openedTrade, $price, $priceObject->getDate(), $stopLossPercent *
                                                                                     $openedTradePrice / 100);
                } // Тейк в пунктах
                elseif ($takeProfit && $takeProfit <= $profit) {
                    $this->closeTrade($openedTrade, $price, $priceObject->getDate(), $takeProfit);
                } // Тейк в процентах
                elseif ($takeProfitPercent && $takeProfitPercent <= $percentProfit) {
                    $this->closeTrade($openedTrade, $price, $priceObject->getDate(), $takeProfitPercent *
                                                                                     $openedTradePrice / 100);
                }
            }

            // Проверка наличия открытых сделок
            if (!$strategy->openIfExist() && $this->hasOpenedTrades) {
                continue;
            }

            // Открытие новых сделок
            foreach ($strategy->getSignals() as $signal) {
                $direction = $signal->getDirection();

                if ($this->indicatorsPassed($priceObject, $direction, $signal)) {
                    $trade = new Trade();
                    $trade->setDirection($direction);
                    $trade->setOpen($price);
                    $trade->setOpenDate($priceObject->getDate());
                    $trade->setSymbol($strategy->getSymbol());
                    $trade->setVolume($volume);
                    $trade->setSignal($signal);

                    $this->hasOpenedTrades = true;

                    $trades[] = $trade;
                }
            }
        }

        return $trades;
    }

    /**
     * Получение даты первой котировки по которой анализируется стратегия
     * @param Strategy $strategy
     * @return \DateTime|null
     */
    public function getFirstPriceDate(Strategy $strategy) {
        $prices = $this->getAllPrices($strategy->getSymbolName()[$strategy->getSymbol()]);
        $firstPrice = reset($prices);

        if ($firstPrice instanceof Price) {
            return $firstPrice->getDate();
        } else {
            return null;
        }
    }

    /**
     * Получение даты последней котировки по которой анализируется стратегия
     * @param Strategy $strategy
     * @return \DateTime|null
     */
    public function getLastPriceDate(Strategy $strategy) {
        $prices = $this->getAllPrices($strategy->getSymbolName()[$strategy->getSymbol()]);
        $lastPrice = end($prices);

        if ($lastPrice instanceof Price) {
            return $lastPrice->getDate();
        } else {
            return null;
        }
    }

    /**
     * Расчет прибыли по серии сделок в процентах
     * @param array $trades
     * @return float|int
     */
    public function calculatePercentProfit(array $trades) {
        $percentProfit = 100;
        foreach ($trades as $trade) {
            if ($trade instanceof Trade) {
                $price = $trade->getOpen();
                $profit = $trade->getProfit();
                $percentProfit = $profit / $price * 100 + $percentProfit;
            }
        }

        return round($percentProfit - 100, 2);
    }

    /**
     * Получение имен для усредненных групп индикаторов
     * @return array
     */
    public function getAverageNames() {
        return [
            self::AVERAGE_SHORTTERM  => 'Средний показатель краткосрочных индикаторов',
            self::AVERAGE_MIDDLETERM => 'Средний показатель среднесрочных индикаторов',
            self::AVERAGE_LONGTERM   => 'Средний показатель долгосрочных индикаторов',
            self::AVERAGE_OVERALL    => 'Средний показатель всех индикаторов',
        ];
    }

    /**
     * Получение имени геттера для усредненных групп индикаторов
     * @param integer $average
     * @return array
     */
    private function getAverageFunctionName($average) {
        $averageFunctionNames = [
            self::AVERAGE_SHORTTERM  => 'getShorttermAverage',
            self::AVERAGE_MIDDLETERM => 'getMiddletermAverage',
            self::AVERAGE_LONGTERM   => 'getLongtermAverage',
            self::AVERAGE_OVERALL    => 'getOverall',
        ];

        return $averageFunctionNames[$average];
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

    /**
     * Проверка на срабатывание всех индикаторов сигнала
     * @param Price  $priceObject
     * @param int    $direction
     * @param Signal $signal
     * @return bool
     */
    private function indicatorsPassed(Price $priceObject, $direction, Signal $signal) {
        $indicatorValues = $signal->getIndicatorValues();

        $indicatorsPassed = 0;
        foreach ($indicatorValues->toArray() as $indicatorValueObject) {
            /** @var IndicatorValue $indicatorValueObject */
            $indicator = $indicatorValueObject->getIndicator();
            $indicatorMethod = 'get' . $indicator->getStrategyMethod();

            $priceIndicatorValue = $priceObject->$indicatorMethod();
            $indicatorValue = $indicatorValueObject->getValue();

            // Если индикатор является коммулятивным
            if ($priceIndicatorValue > 1) {
                $indicatorValue = Signal::SIGNAL_MAXIMUM_BUY;
            } elseif ($priceIndicatorValue < -1) {
                $indicatorValue = Signal::SIGNAL_MAXIMUM_SELL;
            }

            if (($direction == $signal::DIRECTION_BUY && $priceIndicatorValue >= $indicatorValue)
                || ($direction == $signal::DIRECTION_SELL && $priceIndicatorValue <= $indicatorValue)
            ) {
                $indicatorsPassed++;
            }
        }

        return $indicatorsPassed == count($indicatorValues);
    }

    /**
     * Закрытие сделки
     * @param Trade     $trade
     * @param float     $closePrice
     * @param \DateTime $closeDate
     * @param float     $profit
     */
    private function closeTrade(Trade $trade, $closePrice, \DateTime $closeDate, $profit) {
        $trade->setClose($closePrice);
        $trade->setCloseDate($closeDate);
        $trade->setProfit(round($profit, 2));
        $this->hasOpenedTrades = false;
    }
}
