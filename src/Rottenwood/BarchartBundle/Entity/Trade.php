<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trade
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Trade
{
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
     * @ORM\Column(name="symbol", type="string", length=255)
     */
    private $symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=255)
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
     * @ORM\Column(name="openTime", type="datetime")
     */
    private $openTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closeTime", type="datetime")
     */
    private $closeTime;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Trade
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set direction
     *
     * @param string $direction
     * @return Trade
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string 
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set open
     *
     * @param float $open
     * @return Trade
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return float 
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set close
     *
     * @param float $close
     * @return Trade
     */
    public function setClose($close)
    {
        $this->close = $close;

        return $this;
    }

    /**
     * Get close
     *
     * @return float 
     */
    public function getClose()
    {
        return $this->close;
    }

    /**
     * Set high
     *
     * @param float $high
     * @return Trade
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return float 
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Set drawdown
     *
     * @param float $drawdown
     * @return Trade
     */
    public function setDrawdown($drawdown)
    {
        $this->drawdown = $drawdown;

        return $this;
    }

    /**
     * Get drawdown
     *
     * @return float 
     */
    public function getDrawdown()
    {
        return $this->drawdown;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Trade
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set openTime
     *
     * @param \DateTime $openTime
     * @return Trade
     */
    public function setOpenTime($openTime)
    {
        $this->openTime = $openTime;

        return $this;
    }

    /**
     * Get openTime
     *
     * @return \DateTime 
     */
    public function getOpenTime()
    {
        return $this->openTime;
    }

    /**
     * Set closeTime
     *
     * @param \DateTime $closeTime
     * @return Trade
     */
    public function setCloseTime($closeTime)
    {
        $this->closeTime = $closeTime;

        return $this;
    }

    /**
     * Get closeTime
     *
     * @return \DateTime 
     */
    public function getCloseTime()
    {
        return $this->closeTime;
    }
}
