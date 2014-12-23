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
     * Массив соответствия индикаторов их названиям
     * @return array
     */
    public static function getIndicatorsNames() {
        return [
            // Краткосрочные
            '7 Day Average Directional Indicator',
            '10 - 8 Day Moving Average Hilo Channel',
            '20 Day Moving Average vs Price',
            '20 - 50 Day MACD Oscillator',
            '20 Day Bollinger Bands',

            // Среднесрочные
            '40 Day Commodity Channel Index',
            '50 Day Moving Average vs Price',
            '20 - 100 Day MACD Oscillator',
            '50 Day Parabolic Time/Price',

            // Долгосрочные
            '60 Day Commodity Channel Index',
            '100 Day Moving Average vs Price',
            '50 - 100 Day MACD Oscillator',

            // Коммулятивные
            'Общий показатель всех индикаторов',
            'Общий показатель краткосрочных индикаторов',
            'Общий показатель среднесрочных индикаторов',
            'Общий показатель долгосрочных индикаторов',
        ];
    }
}
