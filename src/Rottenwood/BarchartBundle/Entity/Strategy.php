<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Стратегии
 * @ORM\Table(name="strategies")
 * @ORM\Entity
 */
class Strategy extends Symbol {

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
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Analitic")
     */
    private $author;

    /**
     * @Assert\Count(min=1, minMessage="У стратегии должен быть создан хотя бы один сигнал!")
     * @ORM\ManyToMany(targetEntity="Signal", cascade={"persist"})
     * @ORM\JoinTable(name="strategies_signals",
     *      joinColumns={@ORM\JoinColumn()},
     *      inverseJoinColumns={@ORM\JoinColumn()}
     *      )
     **/
    private $signals;

    /**
     * @var int
     * @ORM\Column(name="symbol", type="smallint")
     */
    private $symbol;


    public function __construct() {
        $this->signals = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set name
     * @param string $name
     * @return Strategy
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
     * Set author
     * @param Analitic $author
     * @return Strategy
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     * @return Analitic
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set signals
     * @param Signal[] $signals
     * @return Strategy
     */
    public function setSignals($signals) {
        $this->signals = $signals;

        return $this;
    }

    /**
     * Get signals
     * @return Signal[]
     */
    public function getSignals() {
        return $this->signals;
    }

    /**
     * @return int
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * @param int $symbol
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }
}
