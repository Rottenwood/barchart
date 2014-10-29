<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Price {

    const TREND_STRENGTH_NONE = 0;
    const TREND_STRENGTH_MINIMUM = 1;
    const TREND_STRENGTH_WEAK = 2;
    const TREND_STRENGTH_AVERAGE = 3;
    const TREND_STRENGTH_STRONG = 4;
    const TREND_STRENGTH_MAXIMUM = 5;

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
    private $sMavp;

    /**
     * @var integer
     * @ORM\Column(name="s_macd", type="integer")
     */
    private $sMacd;

    /**
     * @var integer
     * @ORM\Column(name="s_bollinger", type="integer")
     */
    private $bollinger;

    /**
     * @var integer
     * @ORM\Column(name="m_cci", type="integer")
     */
    private $mCci;

    /**
     * @var integer
     * @ORM\Column(name="m_mavp", type="integer")
     */
    private $mMavp;

    /**
     * @var integer
     * @ORM\Column(name="m_macd", type="integer")
     */
    private $mMacd;

    /**
     * @var integer
     * @ORM\Column(name="m_parabolic", type="integer")
     */
    private $parabolic;

    /**
     * @var integer
     * @ORM\Column(name="l_cci", type="integer")
     */
    private $lCci;

    /**
     * @var integer
     * @ORM\Column(name="l_mavp", type="integer")
     */
    private $lMavp;

    /**
     * @var integer
     * @ORM\Column(name="l_macd", type="integer")
     */
    private $lMacd;

    /**
     * @var integer
     * @ORM\Column(name="trendspotter", type="integer")
     */
    private $trendspotter;

    /**
     * @var integer
     * @ORM\Column(name="s_average", type="integer")
     */
    private $sAverage;

    /**
     * @var integer
     * @ORM\Column(name="m_average", type="integer")
     */
    private $mAverage;

    /**
     * @var integer
     * @ORM\Column(name="l_average", type="integer")
     */
    private $lAverage;

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
     * @param int $lAverage
     */
    public function setLAverage($lAverage) {
        $this->lAverage = $lAverage;
    }

    /**
     * @return int
     */
    public function getLAverage() {
        return $this->lAverage;
    }

    /**
     * @param int $lCci
     */
    public function setLCci($lCci) {
        $this->lCci = $lCci;
    }

    /**
     * @return int
     */
    public function getLCci() {
        return $this->lCci;
    }

    /**
     * @param int $lMacd
     */
    public function setLMacd($lMacd) {
        $this->lMacd = $lMacd;
    }

    /**
     * @return int
     */
    public function getLMacd() {
        return $this->lMacd;
    }

    /**
     * @param int $lMavp
     */
    public function setLMavp($lMavp) {
        $this->lMavp = $lMavp;
    }

    /**
     * @return int
     */
    public function getLMavp() {
        return $this->lMavp;
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
     * @param int $mAverage
     */
    public function setMAverage($mAverage) {
        $this->mAverage = $mAverage;
    }

    /**
     * @return int
     */
    public function getMAverage() {
        return $this->mAverage;
    }

    /**
     * @param int $mCci
     */
    public function setMCci($mCci) {
        $this->mCci = $mCci;
    }

    /**
     * @return int
     */
    public function getMCci() {
        return $this->mCci;
    }

    /**
     * @param int $mMacd
     */
    public function setMMacd($mMacd) {
        $this->mMacd = $mMacd;
    }

    /**
     * @return int
     */
    public function getMMacd() {
        return $this->mMacd;
    }

    /**
     * @param int $mMavp
     */
    public function setMMavp($mMavp) {
        $this->mMavp = $mMavp;
    }

    /**
     * @return int
     */
    public function getMMavp() {
        return $this->mMavp;
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
     * @param int $sAverage
     */
    public function setSAverage($sAverage) {
        $this->sAverage = $sAverage;
    }

    /**
     * @return int
     */
    public function getSAverage() {
        return $this->sAverage;
    }

    /**
     * @param int $sMacd
     */
    public function setSMacd($sMacd) {
        $this->sMacd = $sMacd;
    }

    /**
     * @return int
     */
    public function getSMacd() {
        return $this->sMacd;
    }

    /**
     * @param int $sMavp
     */
    public function setSMavp($sMavp) {
        $this->sMavp = $sMavp;
    }

    /**
     * @return int
     */
    public function getSMavp() {
        return $this->sMavp;
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

    /**
     * Получение массива соответствий уровней силы тренда их ключам в БД
     * @return array
     */
    public static function getTrendStrengthName() {
        return array(
            self::TREND_STRENGTH_NONE => '&nbsp;',
            self::TREND_STRENGTH_MINIMUM => 'Minimum',
            self::TREND_STRENGTH_WEAK => 'Weak',
            self::TREND_STRENGTH_AVERAGE => 'Average',
            self::TREND_STRENGTH_STRONG => 'Strong',
            self::TREND_STRENGTH_MAXIMUM => 'Maximum',
        );
    }
}
