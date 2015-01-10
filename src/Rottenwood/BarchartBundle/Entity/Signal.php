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

//    const INDICATOR_OVERALL = 20;
//    const INDICATOR_AVERAGE_SHORTTERM = 21;
//    const INDICATOR_AVERAGE_MIDDLETERM = 22;
//    const INDICATOR_AVERAGE_LONGTERM = 23;

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
     * @var Collection
     * @ORM\OneToMany(targetEntity="Trade", mappedBy="signal")
     */
    private $trades;

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
     * @return Collection
     */
    public function getTrades() {
        return $this->trades;
    }

    /**
     * @param Collection $trades
     */
    public function setTrades($trades) {
        $this->trades = $trades;
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
