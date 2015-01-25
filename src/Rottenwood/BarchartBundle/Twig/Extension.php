<?php
/**
 * Author: Rottenwood
 * Date Created: 10.01.15 6:31
 */

namespace Rottenwood\BarchartBundle\Twig;

use Rottenwood\BarchartBundle\Entity\Signal;
use Rottenwood\BarchartBundle\Entity\Strategy;

class Extension extends \Twig_Extension {

    public function getFunctions() {
        $functions = [
            'dates_diff' => new \Twig_Function_Method($this, 'datesDiff'),
        ];

        return $functions;
    }

    public function getFilters() {
        return [
            'direction_name' => new \Twig_Filter_Method($this, 'getDirectionName'),
            'symbol_name'    => new \Twig_Filter_Method($this, 'getSymbolName'),
        ];
    }

    public function getName() {
        return 'foracle.twig.extension';
    }

    /**
     * Разница двух дат
     * @param \DateTime $firstDate
     * @param \DateTime $secondDate
     * @return string
     */
    public function datesDiff(\DateTime $firstDate, \DateTime $secondDate) {
        $interval = $firstDate->diff($secondDate);

        return $interval;
    }

    /**
     * Название торгового инструмента
     * @param int $symbol
     * @return string
     */
    public function getSymbolName($symbol) {
        $symbolNames = Strategy::getRussianSymbolName();

        return array_key_exists($symbol, $symbolNames) ? $symbolNames[$symbol] : '';
    }

    /**
     * Название направления сделки
     * @param int $direction
     * @return string
     */
    public function getDirectionName($direction) {
        $directionNames = Signal::getDirectionsNames();

        return array_key_exists($direction, $directionNames) ? $directionNames[$direction] : '';
    }
}
