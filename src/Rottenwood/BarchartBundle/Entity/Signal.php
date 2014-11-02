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
     */
    public function setDirection($direction) {
        $this->direction = $direction;
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
     * Массив соответствия индикаторам методов из сущности Price
     * @return array
     */
    public static function getIndicatorsMethodNames() {
        return array(
            self::INDICATOR_7_DAY_AVERAGE_DIRECTION              => 'Ad',
            self::INDICATOR_10_8_DAY_MOVING_AVERAGE_HILO_CHANNEL => 'Mahilo',
            self::INDICATOR_20_DAY_MOVING_AVERAGE_VS_PRICE       => 'SMavp',
            self::INDICATOR_20_50_DAY_MACD                       => 'SMacd',
            self::INDICATOR_20_DAY_BOLLINGER_BANDS               => 'Bollinger',

            self::INDICATOR_40_DAY_COMMIDITY_CHANNEL_INDEX       => 'MCci',
            self::INDICATOR_50_DAY_MOVING_AVERAGE_VS_PRICE       => 'MMavp',
            self::INDICATOR_20_100_DAY_MACD                      => 'MMacd',
            self::INDICATOR_50_DAY_PARABOLIC_TIME_PRICE          => 'Parabolic',

            self::INDICATOR_60_DAY_COMMODITY_CHANNEL_INDEX       => 'LCci',
            self::INDICATOR_100_DAY_MOVING_AVERAGE_VS_PRICE      => 'LMavp',
            self::INDICATOR_50_100_DAY_MACD                      => 'LMacd',
        );
    }
}
