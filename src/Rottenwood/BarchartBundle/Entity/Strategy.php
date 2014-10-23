<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Стратегии
 *
 * @ORM\Table(name="strategies")
 * @ORM\Entity
 */
class Strategy {
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
     * @ORM\ManyToMany(targetEntity="Analitic", mappedBy="strategies")
     */
    private $authors;

    /**
     * @ORM\ManyToMany(targetEntity="Signal")
     * @ORM\JoinTable(name="strategies_signals",
     *      joinColumns={@ORM\JoinColumn()},
     *      inverseJoinColumns={@ORM\JoinColumn()}
     *      )
     **/
    private $signals;


    public function __construct() {
        $this->signals = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

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
     * @return Strategy
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
     * Set authors
     *
     * @param string $authors
     * @return Strategy
     */
    public function setAuthors($authors) {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get authors
     *
     * @return string
     */
    public function getAuthors() {
        return $this->authors;
    }

    /**
     * Set signals
     *
     * @param Signal[] $signals
     * @return Strategy
     */
    public function setSignals($signals) {
        $this->signals = $signals;

        return $this;
    }

    /**
     * Get signals
     *
     * @return Signal[]
     */
    public function getSignals() {
        return $this->signals;
    }
}
