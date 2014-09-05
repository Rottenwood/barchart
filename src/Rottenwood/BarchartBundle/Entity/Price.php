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
     * @ORM\Column(name="unixtime", type="string", length=20)
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
     * @var string
     * @ORM\Column(name="s_ad", type="string", length=255)
     */
    private $ad;

    /**
     * @var string
     * @ORM\Column(name="s_mahilo", type="string", length=255)
     */
    private $mahilo;

    /**
     * @var string
     * @ORM\Column(name="s_mavp", type="string", length=255)
     */
    private $s_mavp;

    /**
     * @var string
     * @ORM\Column(name="s_macd", type="string", length=255)
     */
    private $s_macd;

    /**
     * @var string
     * @ORM\Column(name="s_bollinger", type="string", length=255)
     */
    private $bollinger;

    /**
     * @var string
     * @ORM\Column(name="m_cci", type="string", length=255)
     */
    private $m_cci;

    /**
     * @var string
     * @ORM\Column(name="m_mavp", type="string", length=255)
     */
    private $m_mavp;

    /**
     * @var string
     * @ORM\Column(name="m_macd", type="string", length=255)
     */
    private $m_macd;

    /**
     * @var string
     * @ORM\Column(name="m_parabolic", type="string", length=255)
     */
    private $parabolic;

    /**
     * @var string
     * @ORM\Column(name="l_cci", type="string", length=255)
     */
    private $l_cci;

    /**
     * @var string
     * @ORM\Column(name="l_mavp", type="string", length=255)
     */
    private $l_mavp;

    /**
     * @var string
     * @ORM\Column(name="l_macd", type="string", length=255)
     */
    private $l_macd;

    /**
     * @var string
     * @ORM\Column(name="trendspotter", type="string", length=255)
     */
    private $trendspotter;

    /**
     * @var string
     * @ORM\Column(name="s_average", type="string", length=255)
     */
    private $s_average;

    /**
     * @var string
     * @ORM\Column(name="m_average", type="string", length=255)
     */
    private $m_average;

    /**
     * @var string
     * @ORM\Column(name="l_average", type="string", length=255)
     */
    private $l_average;

    /**
     * @var string
     * @ORM\Column(name="overall", type="string", length=255)
     */
    private $overall;

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

    /**
     * @param string $ad
     */
    public function setAd($ad) {
        $this->ad = $ad;
    }

    /**
     * @return string
     */
    public function getAd() {
        return $this->ad;
    }

    /**
     * @param string $bollinger
     */
    public function setBollinger($bollinger) {
        $this->bollinger = $bollinger;
    }

    /**
     * @return string
     */
    public function getBollinger() {
        return $this->bollinger;
    }

    /**
     * @param string $l_average
     */
    public function setLAverage($l_average) {
        $this->l_average = $l_average;
    }

    /**
     * @return string
     */
    public function getLAverage() {
        return $this->l_average;
    }

    /**
     * @param string $l_cci
     */
    public function setLCci($l_cci) {
        $this->l_cci = $l_cci;
    }

    /**
     * @return string
     */
    public function getLCci() {
        return $this->l_cci;
    }

    /**
     * @param string $l_macd
     */
    public function setLMacd($l_macd) {
        $this->l_macd = $l_macd;
    }

    /**
     * @return string
     */
    public function getLMacd() {
        return $this->l_macd;
    }

    /**
     * @param string $l_mavp
     */
    public function setLMavp($l_mavp) {
        $this->l_mavp = $l_mavp;
    }

    /**
     * @return string
     */
    public function getLMavp() {
        return $this->l_mavp;
    }

    /**
     * @param string $m_average
     */
    public function setMAverage($m_average) {
        $this->m_average = $m_average;
    }

    /**
     * @return string
     */
    public function getMAverage() {
        return $this->m_average;
    }

    /**
     * @param string $m_cci
     */
    public function setMCci($m_cci) {
        $this->m_cci = $m_cci;
    }

    /**
     * @return string
     */
    public function getMCci() {
        return $this->m_cci;
    }

    /**
     * @param string $m_macd
     */
    public function setMMacd($m_macd) {
        $this->m_macd = $m_macd;
    }

    /**
     * @return string
     */
    public function getMMacd() {
        return $this->m_macd;
    }

    /**
     * @param string $m_mavp
     */
    public function setMMavp($m_mavp) {
        $this->m_mavp = $m_mavp;
    }

    /**
     * @return string
     */
    public function getMMavp() {
        return $this->m_mavp;
    }

    /**
     * @param string $mahilo
     */
    public function setMahilo($mahilo) {
        $this->mahilo = $mahilo;
    }

    /**
     * @return string
     */
    public function getMahilo() {
        return $this->mahilo;
    }

    /**
     * @param string $overall
     */
    public function setOverall($overall) {
        $this->overall = $overall;
    }

    /**
     * @return string
     */
    public function getOverall() {
        return $this->overall;
    }

    /**
     * @param string $parabolic
     */
    public function setParabolic($parabolic) {
        $this->parabolic = $parabolic;
    }

    /**
     * @return string
     */
    public function getParabolic() {
        return $this->parabolic;
    }

    /**
     * @param string $s_average
     */
    public function setSAverage($s_average) {
        $this->s_average = $s_average;
    }

    /**
     * @return string
     */
    public function getSAverage() {
        return $this->s_average;
    }

    /**
     * @param string $s_macd
     */
    public function setSMacd($s_macd) {
        $this->s_macd = $s_macd;
    }

    /**
     * @return string
     */
    public function getSMacd() {
        return $this->s_macd;
    }

    /**
     * @param string $s_mavp
     */
    public function setSMavp($s_mavp) {
        $this->s_mavp = $s_mavp;
    }

    /**
     * @return string
     */
    public function getSMavp() {
        return $this->s_mavp;
    }

    /**
     * @param string $trendspotter
     */
    public function setTrendspotter($trendspotter) {
        $this->trendspotter = $trendspotter;
    }

    /**
     * @return string
     */
    public function getTrendspotter() {
        return $this->trendspotter;
    }

}
