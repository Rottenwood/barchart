<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
class Price {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="symbol", type="string", length=255)
     */
    private $symbol;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(name="commodity", type="string", length=255)
     */
    private $commodity;

    /**
     * @var string
     * @ORM\Column(name="expiration", type="string", length=255)
     */
    private $expiration;

    /**
     * @var string
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="time", type="string", length=255)
     */
    private $time;

    /**
     * @var string
     * @ORM\Column(name="timelocal", type="string", length=255)
     */
    private $timelocal;

    /**
     * @var string
     * @ORM\Column(name="unixtime", type="datetime")
     */
    private $unixtime;

    /**
     * @var string
     * @ORM\Column(name="high", type="string", length=255)
     */
    private $high;

    /**
     * @var string
     * @ORM\Column(name="low", type="string", length=255)
     */
    private $low;

    /**
     * @var string
     * @ORM\Column(name="open", type="string", length=255)
     */
    private $open;

    /**
     * @var string
     * @ORM\Column(name="close", type="string", length=255)
     */
    private $close;

    /**
     * @var string
     * @ORM\Column(name="52whigh", type="string", length=255)
     */
    private $fivetwoweekhigh;

    /**
     * @var string
     * @ORM\Column(name="52wlow", type="string", length=255)
     */
    private $fivetwoweeklow;

    /**
     * @var string
     * @ORM\Column(name="volume", type="string", length=255)
     */
    private $volume;

    /**
     * @var string
     * @ORM\Column(name="openinterest", type="string", length=255)
     */
    private $openinterest;

    /**
     * @var string
     * @ORM\Column(name="weightedalpha", type="string", length=255)
     */
    private $weightedalpha;

    /**
     * @var string
     * @ORM\Column(name="standartdev", type="string", length=255)
     */
    private $standartdev;

    /**
     * @var string
     * @ORM\Column(name="20daverage", type="string", length=255)
     */
    private $twentydaverage;

    /**
     * @var string
     * @ORM\Column(name="100daverage", type="string", length=255)
     */
    private $hundreddaverage;

    /**
     * @var string
     * @ORM\Column(name="14drelstrength", type="string", length=255)
     */
    private $fourteendrelstrength;

    /**
     * @var string
     * @ORM\Column(name="14dstochastic", type="string", length=255)
     */
    private $fourteendstochastic;

    /**
     * @var string
     * @ORM\Column(name="trend", type="string", length=255)
     */
    private $trend;

    /**
     * @var string
     * @ORM\Column(name="trendstrength", type="string", length=255)
     */
    private $trendstrength;

    /**
     * @param string $close
     */
    public function setClose($close) {
        $this->close = $close;
    }

    /**
     * @return string
     */
    public function getClose() {
        return $this->close;
    }

    /**
     * @param string $commodity
     */
    public function setCommodity($commodity) {
        $this->commodity = $commodity;
    }

    /**
     * @return string
     */
    public function getCommodity() {
        return $this->commodity;
    }

    /**
     * @param string $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param string $expiration
     */
    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }

    /**
     * @return string
     */
    public function getExpiration() {
        return $this->expiration;
    }

    /**
     * @param string $fivetwoweekhigh
     */
    public function setFivetwoweekhigh($fivetwoweekhigh) {
        $this->fivetwoweekhigh = $fivetwoweekhigh;
    }

    /**
     * @return string
     */
    public function getFivetwoweekhigh() {
        return $this->fivetwoweekhigh;
    }

    /**
     * @param string $fivetwoweeklow
     */
    public function setFivetwoweeklow($fivetwoweeklow) {
        $this->fivetwoweeklow = $fivetwoweeklow;
    }

    /**
     * @return string
     */
    public function getFivetwoweeklow() {
        return $this->fivetwoweeklow;
    }

    /**
     * @param string $fourteendrelstrength
     */
    public function setFourteendrelstrength($fourteendrelstrength) {
        $this->fourteendrelstrength = $fourteendrelstrength;
    }

    /**
     * @return string
     */
    public function getFourteendrelstrength() {
        return $this->fourteendrelstrength;
    }

    /**
     * @param string $fourteendstochastic
     */
    public function setFourteendstochastic($fourteendstochastic) {
        $this->fourteendstochastic = $fourteendstochastic;
    }

    /**
     * @return string
     */
    public function getFourteendstochastic() {
        return $this->fourteendstochastic;
    }

    /**
     * @param string $high
     */
    public function setHigh($high) {
        $this->high = $high;
    }

    /**
     * @return string
     */
    public function getHigh() {
        return $this->high;
    }

    /**
     * @param string $hundreddaverage
     */
    public function setHundreddaverage($hundreddaverage) {
        $this->hundreddaverage = $hundreddaverage;
    }

    /**
     * @return string
     */
    public function getHundreddaverage() {
        return $this->hundreddaverage;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $low
     */
    public function setLow($low) {
        $this->low = $low;
    }

    /**
     * @return string
     */
    public function getLow() {
        return $this->low;
    }

    /**
     * @param string $open
     */
    public function setOpen($open) {
        $this->open = $open;
    }

    /**
     * @return string
     */
    public function getOpen() {
        return $this->open;
    }

    /**
     * @param string $openinterest
     */
    public function setOpeninterest($openinterest) {
        $this->openinterest = $openinterest;
    }

    /**
     * @return string
     */
    public function getOpeninterest() {
        return $this->openinterest;
    }

    /**
     * @param string $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param string $standartdev
     */
    public function setStandartdev($standartdev) {
        $this->standartdev = $standartdev;
    }

    /**
     * @return string
     */
    public function getStandartdev() {
        return $this->standartdev;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * @param string $time
     */
    public function setTime($time) {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string $timelocal
     */
    public function setTimelocal($timelocal) {
        $this->timelocal = $timelocal;
    }

    /**
     * @return string
     */
    public function getTimelocal() {
        return $this->timelocal;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $trend
     */
    public function setTrend($trend) {
        $this->trend = $trend;
    }

    /**
     * @return string
     */
    public function getTrend() {
        return $this->trend;
    }

    /**
     * @param string $trendstrength
     */
    public function setTrendstrength($trendstrength) {
        $this->trendstrength = $trendstrength;
    }

    /**
     * @return string
     */
    public function getTrendstrength() {
        return $this->trendstrength;
    }

    /**
     * @param string $twentydaverage
     */
    public function setTwentydaverage($twentydaverage) {
        $this->twentydaverage = $twentydaverage;
    }

    /**
     * @return string
     */
    public function getTwentydaverage() {
        return $this->twentydaverage;
    }

    /**
     * @param int $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $volume
     */
    public function setVolume($volume) {
        $this->volume = $volume;
    }

    /**
     * @return string
     */
    public function getVolume() {
        return $this->volume;
    }

    /**
     * @param string $weightedalpha
     */
    public function setWeightedalpha($weightedalpha) {
        $this->weightedalpha = $weightedalpha;
    }

    /**
     * @return string
     */
    public function getWeightedalpha() {
        return $this->weightedalpha;
    }

    /**
     * @param string $unixtime
     */
    public function setUnixtime($unixtime) {
        $this->unixtime = $unixtime;
    }

    /**
     * @return string
     */
    public function getUnixtime() {
        return $this->unixtime;
    }
}
