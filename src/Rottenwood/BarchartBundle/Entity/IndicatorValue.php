<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Показания индикаторов
 * @ORM\Table(name="indicators_values")
 * @ORM\Entity
 */
class IndicatorValue {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Indicator")
     * @var Indicator
     */
    private $indicator;

    /**
     * @Assert\NotNull
     * @ORM\Column(name="value", type="smallint", nullable=false)
     * @var int
     */
    private $value;

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return Indicator
     */
    public function getIndicator() {
        return $this->indicator;
    }

    /**
     * @param Indicator $indicator
     */
    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value) {
        $this->value = $value;
    }
}
