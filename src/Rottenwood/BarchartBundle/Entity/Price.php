<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Price {

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
     * @var float
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(name="expiration", type="string", length=255, nullable=true)
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
     * @var integer
     * @ORM\Column(name="unixtime", type="integer")
     */
    private $unixtime;

    /**
     * @var float
     * @ORM\Column(name="high", type="float")
     */
    private $high;

    /**
     * @var float
     * @ORM\Column(name="low", type="float")
     */
    private $low;

    /**
     * @var float
     * @ORM\Column(name="open", type="float")
     */
    private $open;

    /**
     * @var float
     * @ORM\Column(name="close", type="float")
     */
    private $close;

    /**
     * @var float
     * @ORM\Column(name="52whigh", type="float")
     */
    private $fivetwoweekhigh;

    /**
     * @var float
     * @ORM\Column(name="52wlow", type="float")
     */
    private $fivetwoweeklow;

    /**
     * @var integer
     * @ORM\Column(name="volume", type="integer")
     */
    private $volume;

    /**
     * @var integer
     * @ORM\Column(name="openinterest", type="integer")
     */
    private $openinterest;

    /**
     * @var float
     * @ORM\Column(name="weightedalpha", type="float")
     */
    private $weightedalpha;

    /**
     * @var float
     * @ORM\Column(name="standartdev", type="float")
     */
    private $standartdev;

    /**
     * @var float
     * @ORM\Column(name="20daverage", type="float")
     */
    private $twentydaverage;

    /**
     * @var float
     * @ORM\Column(name="100daverage", type="float")
     */
    private $hundreddaverage;

    /**
     * @var float
     * @ORM\Column(name="14drelstrength", type="float")
     */
    private $fourteendrelstrength;

    /**
     * @var float
     * @ORM\Column(name="14dstochastic", type="float")
     */
    private $fourteendstochastic;

    /**
     * @var integer
     * @ORM\Column(name="trend", type="integer")
     */
    private $trend;

    /**
     * @var string
     * @ORM\Column(name="trendstrength", type="string", length=255)
     */
    private $trendstrength;

    /**
     * @var integer
     * @ORM\Column(name="s_ad", type="integer")
     */
    private $ad;

    /**
     * @var integer
     * @ORM\Column(name="s_mahilo", type="integer")
     */
    private $mahilo;

    /**
     * @var integer
     * @ORM\Column(name="s_mavp", type="integer")
     */
    private $s_mavp;

    /**
     * @var integer
     * @ORM\Column(name="s_macd", type="integer")
     */
    private $s_macd;

    /**
     * @var integer
     * @ORM\Column(name="s_bollinger", type="integer")
     */
    private $bollinger;

    /**
     * @var integer
     * @ORM\Column(name="m_cci", type="integer")
     */
    private $m_cci;

    /**
     * @var integer
     * @ORM\Column(name="m_mavp", type="integer")
     */
    private $m_mavp;

    /**
     * @var integer
     * @ORM\Column(name="m_macd", type="integer")
     */
    private $m_macd;

    /**
     * @var integer
     * @ORM\Column(name="m_parabolic", type="integer")
     */
    private $parabolic;

    /**
     * @var integer
     * @ORM\Column(name="l_cci", type="integer")
     */
    private $l_cci;

    /**
     * @var integer
     * @ORM\Column(name="l_mavp", type="integer")
     */
    private $l_mavp;

    /**
     * @var integer
     * @ORM\Column(name="l_macd", type="integer")
     */
    private $l_macd;

    /**
     * @var integer
     * @ORM\Column(name="trendspotter", type="integer")
     */
    private $trendspotter;

    /**
     * @var integer
     * @ORM\Column(name="s_average", type="integer")
     */
    private $s_average;

    /**
     * @var integer
     * @ORM\Column(name="m_average", type="integer")
     */
    private $m_average;

    /**
     * @var integer
     * @ORM\Column(name="l_average", type="integer")
     */
    private $l_average;

    /**
     * @var integer
     * @ORM\Column(name="overall", type="integer")
     */
    private $overall;

    /**
     * @param int $ad
     */
    public function setAd($ad) {
        $this->ad = $ad;
    }

    /**
     * @return int
     */
    public function getAd() {
        return $this->ad;
    }

    /**
     * @param int $bollinger
     */
    public function setBollinger($bollinger) {
        $this->bollinger = $bollinger;
    }

    /**
     * @return int
     */
    public function getBollinger() {
        return $this->bollinger;
    }

    /**
     * @param float $close
     */
    public function setClose($close) {
        $this->close = $close;
    }

    /**
     * @return float
     */
    public function getClose() {
        return $this->close;
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
     * @param float $fivetwoweekhigh
     */
    public function setFivetwoweekhigh($fivetwoweekhigh) {
        $this->fivetwoweekhigh = $fivetwoweekhigh;
    }

    /**
     * @return float
     */
    public function getFivetwoweekhigh() {
        return $this->fivetwoweekhigh;
    }

    /**
     * @param float $fivetwoweeklow
     */
    public function setFivetwoweeklow($fivetwoweeklow) {
        $this->fivetwoweeklow = $fivetwoweeklow;
    }

    /**
     * @return float
     */
    public function getFivetwoweeklow() {
        return $this->fivetwoweeklow;
    }

    /**
     * @param float $fourteendrelstrength
     */
    public function setFourteendrelstrength($fourteendrelstrength) {
        $this->fourteendrelstrength = $fourteendrelstrength;
    }

    /**
     * @return float
     */
    public function getFourteendrelstrength() {
        return $this->fourteendrelstrength;
    }

    /**
     * @param float $fourteendstochastic
     */
    public function setFourteendstochastic($fourteendstochastic) {
        $this->fourteendstochastic = $fourteendstochastic;
    }

    /**
     * @return float
     */
    public function getFourteendstochastic() {
        return $this->fourteendstochastic;
    }

    /**
     * @param float $high
     */
    public function setHigh($high) {
        $this->high = $high;
    }

    /**
     * @return float
     */
    public function getHigh() {
        return $this->high;
    }

    /**
     * @param float $hundreddaverage
     */
    public function setHundreddaverage($hundreddaverage) {
        $this->hundreddaverage = $hundreddaverage;
    }

    /**
     * @return float
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
     * @param int $l_average
     */
    public function setLAverage($l_average) {
        $this->l_average = $l_average;
    }

    /**
     * @return int
     */
    public function getLAverage() {
        return $this->l_average;
    }

    /**
     * @param int $l_cci
     */
    public function setLCci($l_cci) {
        $this->l_cci = $l_cci;
    }

    /**
     * @return int
     */
    public function getLCci() {
        return $this->l_cci;
    }

    /**
     * @param int $l_macd
     */
    public function setLMacd($l_macd) {
        $this->l_macd = $l_macd;
    }

    /**
     * @return int
     */
    public function getLMacd() {
        return $this->l_macd;
    }

    /**
     * @param int $l_mavp
     */
    public function setLMavp($l_mavp) {
        $this->l_mavp = $l_mavp;
    }

    /**
     * @return int
     */
    public function getLMavp() {
        return $this->l_mavp;
    }

    /**
     * @param float $low
     */
    public function setLow($low) {
        $this->low = $low;
    }

    /**
     * @return float
     */
    public function getLow() {
        return $this->low;
    }

    /**
     * @param int $m_average
     */
    public function setMAverage($m_average) {
        $this->m_average = $m_average;
    }

    /**
     * @return int
     */
    public function getMAverage() {
        return $this->m_average;
    }

    /**
     * @param int $m_cci
     */
    public function setMCci($m_cci) {
        $this->m_cci = $m_cci;
    }

    /**
     * @return int
     */
    public function getMCci() {
        return $this->m_cci;
    }

    /**
     * @param int $m_macd
     */
    public function setMMacd($m_macd) {
        $this->m_macd = $m_macd;
    }

    /**
     * @return int
     */
    public function getMMacd() {
        return $this->m_macd;
    }

    /**
     * @param int $m_mavp
     */
    public function setMMavp($m_mavp) {
        $this->m_mavp = $m_mavp;
    }

    /**
     * @return int
     */
    public function getMMavp() {
        return $this->m_mavp;
    }

    /**
     * @param int $mahilo
     */
    public function setMahilo($mahilo) {
        $this->mahilo = $mahilo;
    }

    /**
     * @return int
     */
    public function getMahilo() {
        return $this->mahilo;
    }

    /**
     * @param float $open
     */
    public function setOpen($open) {
        $this->open = $open;
    }

    /**
     * @return float
     */
    public function getOpen() {
        return $this->open;
    }

    /**
     * @param int $openinterest
     */
    public function setOpeninterest($openinterest) {
        $this->openinterest = $openinterest;
    }

    /**
     * @return int
     */
    public function getOpeninterest() {
        return $this->openinterest;
    }

    /**
     * @param int $overall
     */
    public function setOverall($overall) {
        $this->overall = $overall;
    }

    /**
     * @return int
     */
    public function getOverall() {
        return $this->overall;
    }

    /**
     * @param int $parabolic
     */
    public function setParabolic($parabolic) {
        $this->parabolic = $parabolic;
    }

    /**
     * @return int
     */
    public function getParabolic() {
        return $this->parabolic;
    }

    /**
     * @param int $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param int $s_average
     */
    public function setSAverage($s_average) {
        $this->s_average = $s_average;
    }

    /**
     * @return int
     */
    public function getSAverage() {
        return $this->s_average;
    }

    /**
     * @param int $s_macd
     */
    public function setSMacd($s_macd) {
        $this->s_macd = $s_macd;
    }

    /**
     * @return int
     */
    public function getSMacd() {
        return $this->s_macd;
    }

    /**
     * @param int $s_mavp
     */
    public function setSMavp($s_mavp) {
        $this->s_mavp = $s_mavp;
    }

    /**
     * @return int
     */
    public function getSMavp() {
        return $this->s_mavp;
    }

    /**
     * @param float $standartdev
     */
    public function setStandartdev($standartdev) {
        $this->standartdev = $standartdev;
    }

    /**
     * @return float
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
     * @param int $trend
     */
    public function setTrend($trend) {
        $this->trend = $trend;
    }

    /**
     * @return int
     */
    public function getTrend() {
        return $this->trend;
    }

    /**
     * @param int $trendspotter
     */
    public function setTrendspotter($trendspotter) {
        $this->trendspotter = $trendspotter;
    }

    /**
     * @return int
     */
    public function getTrendspotter() {
        return $this->trendspotter;
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
     * @param float $twentydaverage
     */
    public function setTwentydaverage($twentydaverage) {
        $this->twentydaverage = $twentydaverage;
    }

    /**
     * @return float
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
     * @param int $unixtime
     */
    public function setUnixtime($unixtime) {
        $this->unixtime = $unixtime;
    }

    /**
     * @return int
     */
    public function getUnixtime() {
        return $this->unixtime;
    }

    /**
     * @param int $volume
     */
    public function setVolume($volume) {
        $this->volume = $volume;
    }

    /**
     * @return int
     */
    public function getVolume() {
        return $this->volume;
    }

    /**
     * @param float $weightedalpha
     */
    public function setWeightedalpha($weightedalpha) {
        $this->weightedalpha = $weightedalpha;
    }

    /**
     * @return float
     */
    public function getWeightedalpha() {
        return $this->weightedalpha;
    }
}
