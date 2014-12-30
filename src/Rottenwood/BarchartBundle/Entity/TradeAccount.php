<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TradeAccount
 * @ORM\Table(name="accounts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class TradeAccount {

    const BALANCE_100 = 100;
    const BALANCE_1000 = 1000;

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
     * @Assert\NotNull
     */
    private $name;

    /**
     * @var Analitic
     * @ORM\ManyToOne(targetEntity="Analitic")
     */
    private $analitic;

    /**
     * @var \DateTime
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var float
     * @ORM\Column(name="balance", type="float")
     */
    private $balance;

    /**
     * @var float
     * @ORM\Column(name="start_balance", type="float")
     */
    private $startBalance;

    /**
     * @var float
     * @ORM\Column(name="equity", type="float")
     */
    private $equity;

    /**
     * @var Strategy
     * @ORM\ManyToOne(targetEntity="Strategy")
     * @Assert\NotNull(message="strategy.notNull")
     */
    private $strategy;

    /**
     * @var Trade[]
     * @ORM\OneToMany(targetEntity="Trade", mappedBy="account")
     */
    private $trades;

    /**
     * @var bool
     * @ORM\Column(name="isPrivate", type="boolean")
     */
    private $isPrivate;

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
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return TradeAccount
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
     * Set creationDate
     * @param \DateTime $creationDate
     * @return TradeAccount
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     * @return \DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set balance
     * @param float $balance
     * @return TradeAccount
     */
    public function setBalance($balance) {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float
     */
    public function getStartBalance() {
        return $this->startBalance;
    }

    /**
     * @param float $startBalance
     */
    public function setStartBalance($startBalance) {
        $this->startBalance = $startBalance;
    }

    /**
     * Get balance
     * @return float
     */
    public function getBalance() {
        return $this->balance;
    }

    /**
     * Set equity
     * @param float $equity
     * @return TradeAccount
     */
    public function setEquity($equity) {
        $this->equity = $equity;

        return $this;
    }

    /**
     * Get equity
     * @return float
     */
    public function getEquity() {
        return $this->equity;
    }

    /**
     * @return Strategy
     */
    public function getStrategy() {
        return $this->strategy;
    }

    /**
     * @param Strategy $strategy
     */
    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }

    /**
     * Set trades
     * @param Trade[] $trades
     * @return TradeAccount
     */
    public function setTrades($trades) {
        $this->trades = $trades;

        return $this;
    }

    /**
     * Get trades
     * @return Trade[]
     */
    public function getTrades() {
        return $this->trades;
    }

    /**
     * @return boolean
     */
    public function isPrivate() {
        return $this->isPrivate;
    }

    /**
     * @param boolean $isPrivate
     */
    public function setIsPrivate($isPrivate) {
        $this->isPrivate = $isPrivate;
    }

    public static function getBalanceChoises() {
        return [
            self::BALANCE_100  => '100$',
            self::BALANCE_1000 => '1000$',
        ];
    }
}
