<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TradeAccount
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class TradeAccount {
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
     * @var Analitic
     *
     * @ORM\ManyToOne(targetEntity="Analitic")
     */
    private $analitic;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="smallint")
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float")
     */
    private $balance;

    /**
     * @var float
     *
     * @ORM\Column(name="equity", type="float")
     */
    private $equity;

    /**
     * @var Trade[]
     *
     * @ORM\OneToMany(targetEntity="Trade", mappedBy="account")
     */
    private $trades;

    function __construct() {
        $this->trades = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback() {
        $this->setCreationDate(new \Datetime());
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
     * @return TradeAccount
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
     * @return Analitic
     */
    public function getAnalitic() {
        return $this->analitic;
    }

    /**
     * @param Analitic $analitic
     */
    public function setAnalitic($analitic) {
        $this->analitic = $analitic;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return TradeAccount
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return TradeAccount
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return TradeAccount
     */
    public function setBalance($balance) {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance() {
        return $this->balance;
    }

    /**
     * Set equity
     *
     * @param float $equity
     * @return TradeAccount
     */
    public function setEquity($equity) {
        $this->equity = $equity;

        return $this;
    }

    /**
     * Get equity
     *
     * @return float
     */
    public function getEquity() {
        return $this->equity;
    }

    /**
     * Set trades
     *
     * @param string $trades
     * @return TradeAccount
     */
    public function setTrades($trades) {
        $this->trades = $trades;

        return $this;
    }

    /**
     * Get trades
     *
     * @return string
     */
    public function getTrades() {
        return $this->trades;
    }
}
