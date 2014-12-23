<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    const SIGNAL_MAXIMUM_BUY = 100;
    const SIGNAL_MAXIMUM_SELL = -100;

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
     * @var int
     * @ORM\Column(name="direction", type="integer")
     */
    private $direction;

    /**
     * @Assert\Count(min=1, minMessage="У сигнала должен быть указан хотя бы один индикатор!")
     * @ORM\ManyToMany(targetEntity="IndicatorValue", cascade={"persist"})
     */
    private $indicatorValues;

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
     * @return Collection
     */
    public function getIndicatorValues() {
        return $this->indicatorValues;
    }

    /**
     * @param Collection $indicatorValues
     */
    public function setIndicatorValues($indicatorValues) {
        $this->indicatorValues = $indicatorValues;
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
        return [
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
        ];
    }

    /**
     * Массив соответствия направлений для открытия сделки
     * @return array
     */
    public static function getDirectionsNames() {
        return [
            self::DIRECTION_BUY => 'Покупка',
            self::DIRECTION_SELL => 'Продажа',
        ];
    }
}
