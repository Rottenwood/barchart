<?php
/**
 * Author: Rottenwood
 * Date Created: 10.01.15 6:31
 */

namespace Rottenwood\BarchartBundle\Twig;

class DateExtension extends \Twig_Extension {

    public function getFunctions() {
        $functions = [
            'dates_diff' => new \Twig_Function_Method($this, 'datesDiff'),
        ];

        return $functions;
    }

    public function getName() {
        return 'foracle.twig.extension.date';
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

}
