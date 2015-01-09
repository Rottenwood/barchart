<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class Price {

    const CONTRACT_TYPE_FUTURES = 1;
    const CONTRACT_TYPE_FOREX = 2;

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
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
    private $fiveTwoWeekHigh;

    /**
     * @var float
     * @ORM\Column(name="52wlow", type="float")
     */
    private $fiveTwoWeekLow;

    /**
     * @var integer
     * @ORM\Column(name="volume", type="integer")
     */
    private $volume;

    /**
     * @var integer
     * @ORM\Column(name="open_interest", type="integer")
     */
    private $openInterest;

    /**
     * @var float
     * @ORM\Column(name="weighted_alpha", type="float")
     */
    private $weightedAlpha;

    /**
     * @var float
     * @ORM\Column(name="standart_dev", type="float")
     */
    private $standartDev;

    /**
     * @var float
     * @ORM\Column(name="20daverage", type="float")
     */
    private $twentyDayAverage;

    /**
     * @var float
     * @ORM\Column(name="100daverage", type="float")
     */
    private $hundredDayAverage;

    /**
     * @var float
     * @ORM\Column(name="14drelstrength", type="float")
     */
    private $fourteenDayRelStrength;

    /**
     * @var float
     * @ORM\Column(name="14dstochastic", type="float")
     */
    private $fourteenDayStochastic;

    /**
     * @var integer
     * @ORM\Column(name="trend", type="integer")
     */
    private $trend;

    /**
     * @var int
     * @ORM\Column(name="trend_strength", type="smallint")
     */
    private $trendStrength;

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
    private $shorttermMavp;

    /**
     * @var integer
     * @ORM\Column(name="s_macd", type="integer")
     */
    private $shorttermMacd;

    /**
     * @var integer
     * @ORM\Column(name="s_bollinger", type="integer")
     */
    private $bollinger;

    /**
     * @var integer
     * @ORM\Column(name="m_cci", type="integer")
     */
    private $mediumtermCci;

    /**
     * @var integer
     * @ORM\Column(name="m_mavp", type="integer")
     */
    private $mediumtermMavp;

    /**
     * @var integer
     * @ORM\Column(name="m_macd", type="integer")
     */
    private $mediumtermMacd;

    /**
     * @var integer
     * @ORM\Column(name="m_parabolic", type="integer")
     */
    private $parabolic;

    /**
     * @var integer
     * @ORM\Column(name="l_cci", type="integer")
     */
    private $longtermCci;

    /**
     * @var integer
     * @ORM\Column(name="l_mavp", type="integer")
     */
    private $longtermMavp;

    /**
     * @var integer
     * @ORM\Column(name="l_macd", type="integer")
     */
    private $longtermMacd;

    /**
     * @var integer
     * @ORM\Column(name="trendspotter", type="integer")
     */
    private $trendspotter;

    /**
     * @var integer
     * @ORM\Column(name="s_average", type="integer")
     */
    private $shorttermAverage;

    /**
     * @var integer
     * @ORM\Column(name="m_average", type="integer")
     */
    private $mediumtermAverage;

    /**
     * @var integer
     * @ORM\Column(name="l_average", type="integer")
     */
    private $longtermAverage;

    /**
     * @var integer
     * @ORM\Column(name="overall", type="integer")
     */
    private $overall;

    /**
     * @return int
     */
    public function getAd() {
        return $this->ad;
    }

    /**
     * @param int $ad
     */
    public function setAd($ad) {
        $this->ad = $ad;
    }

    /**
     * @return int
     */
    public function getBollinger() {
        return $this->bollinger;
    }

    /**
     * @param int $bollinger
     */
    public function setBollinger($bollinger) {
        $this->bollinger = $bollinger;
    }

    /**
     * @return float
     */
    public function getClose() {
        return $this->close;
    }

    /**
     * @param float $close
     */
    public function setClose($close) {
        $this->close = $close;
    }

    /**
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getExpiration() {
        return $this->expiration;
    }

    /**
     * @param string $expiration
     */
    public function setExpiration($expiration) {
        $this->expiration = $expiration;
    }

    /**
     * @return float
     */
    public function getFiveTwoWeekHigh() {
        return $this->fiveTwoWeekHigh;
    }

    /**
     * @param float $fiveTwoWeekHigh
     */
    public function setFiveTwoWeekHigh($fiveTwoWeekHigh) {
        $this->fiveTwoWeekHigh = $fiveTwoWeekHigh;
    }

    /**
     * @return float
     */
    public function getFiveTwoWeekLow() {
        return $this->fiveTwoWeekLow;
    }

    /**
     * @param float $fiveTwoWeekLow
     */
    public function setFiveTwoWeekLow($fiveTwoWeekLow) {
        $this->fiveTwoWeekLow = $fiveTwoWeekLow;
    }

    /**
     * @return float
     */
    public function getFourteenDayRelStrength() {
        return $this->fourteenDayRelStrength;
    }

    /**
     * @param float $fourteenDayRelStrength
     */
    public function setFourteenDayRelStrength($fourteenDayRelStrength) {
        $this->fourteenDayRelStrength = $fourteenDayRelStrength;
    }

    /**
     * @return float
     */
    public function getFourteenDayStochastic() {
        return $this->fourteenDayStochastic;
    }

    /**
     * @param float $fourteenDayStochastic
     */
    public function setFourteenDayStochastic($fourteenDayStochastic) {
        $this->fourteenDayStochastic = $fourteenDayStochastic;
    }

    /**
     * @return float
     */
    public function getHigh() {
        return $this->high;
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
    public function getHundredDayAverage() {
        return $this->hundredDayAverage;
    }

    /**
     * @param float $hundredDayAverage
     */
    public function setHundredDayAverage($hundredDayAverage) {
        $this->hundredDayAverage = $hundredDayAverage;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
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
    public function getLongtermAverage() {
        return $this->longtermAverage;
    }

    /**
     * @param int $longtermAverage
     */
    public function setLongtermAverage($longtermAverage) {
        $this->longtermAverage = $longtermAverage;
    }

    /**
     * @return int
     */
    public function getLongtermCci() {
        return $this->longtermCci;
    }

    /**
     * @param int $longtermCci
     */
    public function setLongtermCci($longtermCci) {
        $this->longtermCci = $longtermCci;
    }

    /**
     * @return int
     */
    public function getLongtermMacd() {
        return $this->longtermMacd;
    }

    /**
     * @param int $longtermMacd
     */
    public function setLongtermMacd($longtermMacd) {
        $this->longtermMacd = $longtermMacd;
    }

    /**
     * @return int
     */
    public function getLongtermMavp() {
        return $this->longtermMavp;
    }

    /**
     * @param int $longtermMavp
     */
    public function setLongtermMavp($longtermMavp) {
        $this->longtermMavp = $longtermMavp;
    }

    /**
     * @return float
     */
    public function getLow() {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow($low) {
        $this->low = $low;
    }

    /**
     * @return int
     */
    public function getMahilo() {
        return $this->mahilo;
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
    public function getMediumtermAverage() {
        return $this->mediumtermAverage;
    }

    /**
     * @param int $mediumtermAverage
     */
    public function setMediumtermAverage($mediumtermAverage) {
        $this->mediumtermAverage = $mediumtermAverage;
    }

    /**
     * @return int
     */
    public function getMediumtermCci() {
        return $this->mediumtermCci;
    }

    /**
     * @param int $mediumtermCci
     */
    public function setMediumtermCci($mediumtermCci) {
        $this->mediumtermCci = $mediumtermCci;
    }

    /**
     * @return int
     */
    public function getMediumtermMacd() {
        return $this->mediumtermMacd;
    }

    /**
     * @param int $mediumtermMacd
     */
    public function setMediumtermMacd($mediumtermMacd) {
        $this->mediumtermMacd = $mediumtermMacd;
    }

    /**
     * @return int
     */
    public function getMediumtermMavp() {
        return $this->mediumtermMavp;
    }

    /**
     * @param int $mediumtermMavp
     */
    public function setMediumtermMavp($mediumtermMavp) {
        $this->mediumtermMavp = $mediumtermMavp;
    }

    /**
     * @return float
     */
    public function getOpen() {
        return $this->open;
    }

    /**
     * @param float $open
     */
    public function setOpen($open) {
        $this->open = $open;
    }

    /**
     * @return int
     */
    public function getOpenInterest() {
        return $this->openInterest;
    }

    /**
     * @param int $openInterest
     */
    public function setOpenInterest($openInterest) {
        $this->openInterest = $openInterest;
    }

    /**
     * @return int
     */
    public function getOverall() {
        return $this->overall;
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
    public function getParabolic() {
        return $this->parabolic;
    }

    /**
     * @param int $parabolic
     */
    public function setParabolic($parabolic) {
        $this->parabolic = $parabolic;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getShorttermMacd() {
        return $this->shorttermMacd;
    }

    /**
     * @param int $shorttermMacd
     */
    public function setShorttermMacd($shorttermMacd) {
        $this->shorttermMacd = $shorttermMacd;
    }

    /**
     * @return int
     */
    public function getShorttermMavp() {
        return $this->shorttermMavp;
    }

    /**
     * @param int $shorttermMavp
     */
    public function setSMavp($shorttermMavp) {
        $this->shorttermMavp = $shorttermMavp;
    }

    /**
     * @return int
     */
    public function getShorttermAverage() {
        return $this->shorttermAverage;
    }

    /**
     * @param int $shorttermAverage
     */
    public function setShorttermAverage($shorttermAverage) {
        $this->shorttermAverage = $shorttermAverage;
    }

    /**
     * @return float
     */
    public function getStandartDev() {
        return $this->standartDev;
    }

    /**
     * @param float $standartDev
     */
    public function setStandartDev($standartDev) {
        $this->standartDev = $standartDev;
    }

    /**
     * @return string
     */
    public function getSymbol() {
        return $this->symbol;
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
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getTrend() {
        return $this->trend;
    }

    /**
     * @param int $trend
     */
    public function setTrend($trend) {
        $this->trend = $trend;
    }

    /**
     * @return string
     */
    public function getTrendStrength() {
        return $this->trendStrength;
    }

    /**
     * @param int $trendStrength
     */
    public function setTrendStrength($trendStrength) {
        $this->trendStrength = $trendStrength;
    }

    /**
     * @return int
     */
    public function getTrendspotter() {
        return $this->trendspotter;
    }

    /**
     * @param int $trendspotter
     */
    public function setTrendspotter($trendspotter) {
        $this->trendspotter = $trendspotter;
    }

    /**
     * @return float
     */
    public function getTwentyDayAverage() {
        return $this->twentyDayAverage;
    }

    /**
     * @param float $twentyDayAverage
     */
    public function setTwentyDayAverage($twentyDayAverage) {
        $this->twentyDayAverage = $twentyDayAverage;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->type;
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
    public function getVolume() {
        return $this->volume;
    }

    /**
     * @param int $volume
     */
    public function setVolume($volume) {
        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getWeightedAlpha() {
        return $this->weightedAlpha;
    }

    /**
     * @param float $weightedAlpha
     */
    public function setWeightedAlpha($weightedAlpha) {
        $this->weightedAlpha = $weightedAlpha;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback() {
        $this->setDate(new \Datetime());
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
