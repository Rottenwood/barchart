<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trade
 *
 * @ORM\Table(name="trades")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Trade {
    const DIRECTION_BUY = 1;
    const DIRECTION_SELL = -1;

    const SYMBOL_FUTURES_CORN = 1;
    const SYMBOL_FUTURES_CRUDEOIL = 2;
    const SYMBOL_FUTURES_DJMINI = 3;
    const SYMBOL_FUTURES_EMINI = 4;
    const SYMBOL_FUTURES_GOLD = 5;
    const SYMBOL_FUTURES_NATURALGAS = 6;
    const SYMBOL_FUTURES_SILVER = 7;
    const SYMBOL_FUTURES_SOYBEANS = 8;
    const SYMBOL_FUTURES_WHEAT = 9;

    const SYMBOL_FOREX_AUDUSD = 50;
    const SYMBOL_FOREX_EURUSD = 51;
    const SYMBOL_FOREX_GBPUSD = 52;
    const SYMBOL_FOREX_USDCAD = 53;
    const SYMBOL_FOREX_USDCHF = 54;
    const SYMBOL_FOREX_USDJPY = 55;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var TradeAccount
     *
     * @ORM\ManyToOne(targetEntity="TradeAccount", inversedBy="trades")
     */
    private $account;

    /**
     * @var int
     *
     * @ORM\Column(name="symbol", type="smallint")
     */
    private $symbol;

    /**
     * @var int
     *
     * @ORM\Column(name="direction", type="smallint")
     */
    private $direction;

    /**
     * @var float
     *
     * @ORM\Column(name="open", type="float")
     */
    private $open;

    /**
     * @var float
     *
     * @ORM\Column(name="close", type="float")
     */
    private $close;

    /**
     * @var float
     *
     * @ORM\Column(name="high", type="float")
     */
    private $high;

    /**
     * @var float
     *
     * @ORM\Column(name="drawdown", type="float")
     */
    private $drawdown;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="open_date", type="datetime")
     */
    private $openDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="close_date", type="datetime")
     */
    private $closeDate;

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback() {
        $this->setOpenDate(new \Datetime());
    }

    /**
     * Установка времени закрытия сделки
     */
    public function closeTrade() {
        $this->setCloseDate(new \Datetime());
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
     * @return TradeAccount
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * @param TradeAccount $account
     */
    public function setAccount($account) {
        $this->account = $account;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Trade
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * @return int
     */
    public function getDirection() {
        return $this->direction;
    }

    /**
     * @param int $direction
     */
    public function setDirection($direction) {
        $this->direction = $direction;
    }

    /**
     * Set open
     *
     * @param float $open
     * @return Trade
     */
    public function setOpen($open) {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return float
     */
    public function getOpen() {
        return $this->open;
    }

    /**
     * Set close
     *
     * @param float $close
     * @return Trade
     */
    public function setClose($close) {
        $this->close = $close;

        return $this;
    }

    /**
     * Get close
     *
     * @return float
     */
    public function getClose() {
        return $this->close;
    }

    /**
     * Set high
     *
     * @param float $high
     * @return Trade
     */
    public function setHigh($high) {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return float
     */
    public function getHigh() {
        return $this->high;
    }

    /**
     * Set drawdown
     *
     * @param float $drawdown
     * @return Trade
     */
    public function setDrawdown($drawdown) {
        $this->drawdown = $drawdown;

        return $this;
    }

    /**
     * Get drawdown
     *
     * @return float
     */
    public function getDrawdown() {
        return $this->drawdown;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Trade
     */
    public function setVolume($volume) {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float
     */
    public function getVolume() {
        return $this->volume;
    }

    /**
     * @return \DateTime
     */
    public function getCloseDate() {
        return $this->closeDate;
    }

    /**
     * @param \DateTime $closeDate
     */
    public function setCloseDate($closeDate) {
        $this->closeDate = $closeDate;
    }

    /**
     * @return \DateTime
     */
    public function getOpenDate() {
        return $this->openDate;
    }

    /**
     * @param \DateTime $openDate
     */
    public function setOpenDate($openDate) {
        $this->openDate = $openDate;
    }

    /**
     * Получение массива названий сущностей для торговых символов
     * @return array
     */
    public function getSymbolName() {
        return array(
            self::SYMBOL_FUTURES_CORN => 'Corn',
            self::SYMBOL_FUTURES_CRUDEOIL => 'CrudeOil',
            self::SYMBOL_FUTURES_DJMINI => 'DJMini',
            self::SYMBOL_FUTURES_EMINI => 'Emini',
            self::SYMBOL_FUTURES_GOLD => 'Gold',
            self::SYMBOL_FUTURES_NATURALGAS => 'NaturalGas',
            self::SYMBOL_FUTURES_SILVER => 'Silver',
            self::SYMBOL_FUTURES_SOYBEANS => 'Soybeans',
            self::SYMBOL_FUTURES_WHEAT => 'Wheat',

            self::SYMBOL_FOREX_AUDUSD => 'AUDUSD',
            self::SYMBOL_FOREX_EURUSD => 'EURUSD',
            self::SYMBOL_FOREX_GBPUSD => 'GBPUSD',
            self::SYMBOL_FOREX_USDCAD => 'USDCAD',
            self::SYMBOL_FOREX_USDCHF => 'USDCHF',
            self::SYMBOL_FOREX_USDJPY => 'USDJPY',
        );
    }
}
