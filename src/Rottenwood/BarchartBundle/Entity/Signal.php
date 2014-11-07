<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Торговые сигналы
 * @ORM\Table(name="signals")
 * @ORM\Entity
 */
class Signal {

    const DIRECTION_BUY = 1;
    const DIRECTION_SELL = -1;

    const SIGNAL_SELL = -1;
    const SIGNAL_HOLD = 0;
    const SIGNAL_BUY = 1;

    const INDICATOR_7_DAY_AVERAGE_DIRECTION = 1;
    const INDICATOR_10_8_DAY_MOVING_AVERAGE_HILO_CHANNEL = 2;
    const INDICATOR_20_DAY_MOVING_AVERAGE_VS_PRICE = 3;
    const INDICATOR_20_50_DAY_MACD = 4;
    const INDICATOR_20_DAY_BOLLINGER_BANDS = 5;

    const INDICATOR_40_DAY_COMMIDITY_CHANNEL_INDEX = 6;
    const INDICATOR_50_DAY_MOVING_AVERAGE_VS_PRICE = 7;
    const INDICATOR_20_100_DAY_MACD = 8;
    const INDICATOR_50_DAY_PARABOLIC_TIME_PRICE = 9;

    const INDICATOR_60_DAY_COMMODITY_CHANNEL_INDEX = 10;
    const INDICATOR_100_DAY_MOVING_AVERAGE_VS_PRICE = 11;
    const INDICATOR_50_100_DAY_MACD = 12;

    const INDICATOR_OVERALL = 20;
    const INDICATOR_AVERAGE_SHORTTERM = 21;
    const INDICATOR_AVERAGE_MIDDLETERM = 22;
    const INDICATOR_AVERAGE_LONGTERM = 23;

    const FILTER_TREND_DIRECTION = 1;
    const FILTER_TREND_STRENGTH = 2;
    const FILTER_AVERAGE_SHORTTERM = 3;
    const FILTER_AVERAGE_MIDDLETERM = 4;
    const FILTER_AVERAGE_LONGTERM = 5;
    const FILTER_OVERALL = 6;
    const FILTER_VOLUME = 7;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(name="direction", type="integer")
     */
    private $direction;

    /**
     * @var array
     * @ORM\Column(name="filters", type="simple_array")
     */
    private $filters;

    /**
     * @var array
     * @ORM\Column(name="indicators", type="simple_array")
     */
    private $indicators;

    /**
     * Закрытие сделки с убытком
     * @var int
     * @ORM\Column(name="stop_loss", type="smallint", nullable=true)
     */
    private $stopLoss;

    /**
     * Закрытие сделки по прибыли
     * @var int
     * @ORM\Column(name="take_profit", type="smallint", nullable=true)
     */
    private $takeProfit;

    /**
     * Закрытие сделки с убытком в процентах
     * @var int
     * @ORM\Column(name="stop_loss_percent", type="smallint", nullable=true)
     */
    private $stopLossPercent;

    /**
     * Закрытие сделки по прибыли в процентах
     * @var int
     * @ORM\Column(name="take_profit_percent", type="smallint", nullable=true)
     */
    private $takeProfitPercent;

    /**
     * Закрытие сделки по фактору времени
     * @var \datetime
     * @ORM\Column(name="time_stop", type="datetime", nullable=true)
     */
    private $timeStop;


    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return Signal
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getDirection() {
        return $this->direction;
    }

    /**
     * @param int $direction
     * @return Signal
     */
    public function setDirection($direction) {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Set filters
     * @param array $filters
     * @return Signal
     */
    public function setFilters($filters) {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get filters
     * @return array
     */
    public function getFilters() {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function getIndicators() {
        return $this->indicators;
    }

    /**
     * @param array $indicators
     */
    public function setIndicators($indicators) {
        $this->indicators = $indicators;
    }

    /**
     * @return int
     */
    public function getStopLoss() {
        return $this->stopLoss;
    }

    /**
     * @param int $stopLoss
     */
    public function setStopLoss($stopLoss) {
        $this->stopLoss = $stopLoss;
    }

    /**
     * @return int
     */
    public function getTakeProfit() {
        return $this->takeProfit;
    }

    /**
     * @param int $takeProfit
     */
    public function setTakeProfit($takeProfit) {
        $this->takeProfit = $takeProfit;
    }

    /**
     * @return int
     */
    public function getStopLossPercent() {
        return $this->stopLossPercent;
    }

    /**
     * @param int $stopLossPercent
     */
    public function setStopLossPercent($stopLossPercent) {
        $this->stopLossPercent = $stopLossPercent;
    }

    /**
     * @return int
     */
    public function getTakeProfitPercent() {
        return $this->takeProfitPercent;
    }

    /**
     * @param int $takeProfitPercent
     */
    public function setTakeProfitPercent($takeProfitPercent) {
        $this->takeProfitPercent = $takeProfitPercent;
    }

    /**
     * @return \datetime
     */
    public function getTimeStop() {
        return $this->timeStop;
    }

    /**
     * @param \datetime $timeStop
     */
    public function setTimeStop($timeStop) {
        $this->timeStop = $timeStop;
    }

    /**
     * Массив соответствия индикаторам методов из сущности Price
     * @return array
     */
    public static function getIndicatorsMethodNames() {
        return array(
            self::INDICATOR_7_DAY_AVERAGE_DIRECTION => 'Ad',
            self::INDICATOR_10_8_DAY_MOVING_AVERAGE_HILO_CHANNEL => 'Mahilo',
            self::INDICATOR_20_DAY_MOVING_AVERAGE_VS_PRICE => 'ShorttermMavp',
            self::INDICATOR_20_50_DAY_MACD => 'ShorttermMacd',
            self::INDICATOR_20_DAY_BOLLINGER_BANDS => 'Bollinger',

            self::INDICATOR_40_DAY_COMMIDITY_CHANNEL_INDEX => 'MediumtermCci',
            self::INDICATOR_50_DAY_MOVING_AVERAGE_VS_PRICE => 'MediumtermMavp',
            self::INDICATOR_20_100_DAY_MACD => 'MediumtermMacd',
            self::INDICATOR_50_DAY_PARABOLIC_TIME_PRICE => 'Parabolic',

            self::INDICATOR_60_DAY_COMMODITY_CHANNEL_INDEX => 'LongtermCci',
            self::INDICATOR_100_DAY_MOVING_AVERAGE_VS_PRICE => 'LongtermMavp',
            self::INDICATOR_50_100_DAY_MACD => 'LongtermMacd',

            self::INDICATOR_OVERALL => 'Overall',
            self::INDICATOR_AVERAGE_SHORTTERM => 'ShorttermAverage',
            self::INDICATOR_AVERAGE_MIDDLETERM => 'MediumtermAverage',
            self::INDICATOR_AVERAGE_LONGTERM => 'LongtermAverage',
        );
    }
}
