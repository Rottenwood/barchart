<?php

namespace Rottenwood\BarchartBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

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
     * @var string
     *
     * @ORM\Column(name="trades", type="string", length=255)
     */
    private $trades;

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
     * Set author
     *
     * @param string $author
     * @return TradeAccount
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor() {
        return $this->author;
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
