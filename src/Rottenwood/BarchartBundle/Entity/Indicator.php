<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Индикаторы
 * @ORM\Table(name="indicators")
 * @ORM\Entity
 */
class Indicator {

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
     * @var string
     * @ORM\Column(name="strategy_method", type="string", length=255)
     */
    private $strategyMethod;

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Set name
     * @param string $name
     * @return Indicator
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
     * @return string
     */
    public function getStrategyMethod() {
        return $this->strategyMethod;
    }

    /**
     * @param string $strategyMethod
     */
    public function setStrategyMethod($strategyMethod) {
        $this->strategyMethod = $strategyMethod;
    }

    /**
     * Массив соответствия названий индикаторов и соответствующих методов в сущности Strategy
     * @return array
     */
    public static function getIndicatorsMethodsAndNames() {
        return [
            // Краткосрочные
            'Ad'                => '7 Day Average Directional Indicator',
            'Mahilo'            => '10 - 8 Day Moving Average Hilo Channel',
            'ShorttermMavp'     => '20 Day Moving Average vs Price',
            'ShorttermMacd'     => '20 - 50 Day MACD Oscillator',
            'Bollinger'         => '20 Day Bollinger Bands',

            // Среднесрочные
            'MediumtermCci'     => '40 Day Commodity Channel Index',
            'MediumtermMavp'    => '50 Day Moving Average vs Price',
            'MediumtermMacd'    => '20 - 100 Day MACD Oscillator',
            'Parabolic'         => '50 Day Parabolic Time/Price',

            // Долгосрочные
            'LongtermCci'       => '60 Day Commodity Channel Index',
            'LongtermMavp'      => '100 Day Moving Average vs Price',
            'LongtermMacd'      => '50 - 100 Day MACD Oscillator',

            // Коммулятивные
            'Overall'           => 'Общий показатель всех индикаторов',
            'ShorttermAverage'  => 'Общий показатель краткосрочных индикаторов',
            'MediumtermAverage' => 'Общий показатель среднесрочных индикаторов',
            'LongtermAverage'   => 'Общий показатель долгосрочных индикаторов',
        ];
    }
}
