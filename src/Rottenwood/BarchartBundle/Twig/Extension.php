<?php
/**
 * Author: Rottenwood
 * Date Created: 10.01.15 6:31
 */

namespace Rottenwood\BarchartBundle\Twig;

use Rottenwood\BarchartBundle\Entity\Signal;

class Extension extends \Twig_Extension {

    public function getFunctions() {
        $functions = [
            'dates_diff'     => new \Twig_Function_Method($this, 'datesDiff'),
//            'direction_name' => new \Twig_Function_Method($this, 'getDirectionName'),
        ];

        return $functions;
    }

    public function getFilters() {
        return [
            'direction_name' => new \Twig_Filter_Method($this, 'getDirectionName'),
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

    public function getDirectionName($direction) {
        return Signal::getDirectionsNames()[$direction];
    }

}
