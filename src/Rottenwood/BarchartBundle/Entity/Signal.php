<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Торговые сигналы
 *
 * @ORM\Table(name="signals")
 * @ORM\Entity
 */
class Signal {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="directionBuy", type="boolean")
     */
    private $directionBuy;

    /**
     * @var array
     *
     * @ORM\Column(name="filters", type="simple_array")
     */
    private $filters;

    /**
     * @var string
     *
     * @ORM\Column(name="indicatorsValues", type="string", length=255)
     */
    private $indicatorsValues;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Signal
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set directionBuy
     *
     * @param boolean $directionBuy
     * @return Signal
     */
    public function setDirectionBuy($directionBuy) {
        $this->directionBuy = $directionBuy;

        return $this;
    }

    /**
     * Get directionBuy
     *
     * @return boolean
     */
    public function getDirectionBuy() {
        return $this->directionBuy;
    }

    /**
     * Set filters
     *
     * @param array $filters
     * @return Signal
     */
    public function setFilters($filters) {
        $this->filters = $filters;

        return $this;
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters() {
        return $this->filters;
    }

    /**
     * Set indicatorsValues
     *
     * @param string $indicatorsValues
     * @return Signal
     */
    public function setIndicatorsValues($indicatorsValues) {
        $this->indicatorsValues = $indicatorsValues;

        return $this;
    }

    /**
     * Get indicatorsValues
     *
     * @return string
     */
    public function getIndicatorsValues() {
        return $this->indicatorsValues;
    }
}
