<?php
/**
 * Author: Rottenwood
 * Date Created: 05.09.14 17:42
 */

namespace Rottenwood\BarchartBundle\Service;

use Doctrine\ORM\EntityManager;
use Rottenwood\BarchartBundle\Entity\Price;
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Парсер данных с сайта barchart.com
 * @date    10.09.2014
 * @package Rottenwood\BarchartBundle\Service
 */
class BarchartParserService {

    private $em;
    private $config;
    private $tableTech;

    public function __construct(ConfigService $configService, EntityManager $em) {
        $this->em = $em;
        $this->config = $configService->getConfig();
    }

    /**
     * Получение кода страницы с помощью HtmlDomParser
     * @param $url
     * @param $symbol
     * @return mixed
     */
    protected function parsePage($url, $symbol = '') {
        $page = HtmlDomParser::file_get_html($url . $symbol);

        return $page;
    }

    /**
     * Техническая функция парсинга ряда и строки таблицы
     * @param $tr
     * @return array
     */
    protected function parseIndicator($tr) {
        $tableTech = $this->tableTech;
        $indicator = array();

        $indicator[] = $tableTech->find('tr', $tr)->find('td', 1)->plaintext;
        $indicator[] = $tableTech->find('tr', $tr)->find('td', 2)->plaintext;
        $indicator[] = $tableTech->find('tr', $tr)->find('td', 3)->plaintext;

        return $indicator;
    }

    /**
     * Парсинг таблицы цен для выбранного инструмента
     * @param     $symbol
     * @param int $type
     * @return array
     */
    public function getPrice($symbol, $type) {

        // Определение типа контракта
        if ($type == 1) {
            // Если указан фьючерсный контракт
            $url = $this->config["url"]["price"];
            $symbolName = $symbol;
        } elseif ($type == 2) {
            // Если уканаза валютная пара
            $url = $this->config["url"]["forex"]['GBPUSD'];
            $symbolName = '';
        } else {
            throw new Exception('Не указан тип контракта');
        }

        $urlTechnical = str_replace('quotes', 'opinions', $url);

        $html = $this->parsePage($url, $symbolName);
        $htmlTechnical = $this->parsePage($urlTechnical, $symbolName);

        // Обработка таблицы цен
        $table = $html->find('table#main-content table table', 0);

        $title = $html->find('h1#symname', 0)->innertext;

        // Расчет даты экспирации
        $titleArray = explode(' ', $title);
        end($titleArray);
        $year = prev($titleArray);
        $month = date_parse(prev($titleArray))["month"];

        // Значения таблицы цен
        $priceArray = array(
            "Symbol"         => $symbol,
            "Title"          => $title,
            "Price"          => $html->find('div#divQuotePageHeader span#dtaLast', 0)->plaintext,
            "Commodity"      => $titleArray[0],
            "Date"           => date("d.m.Y"),
            "Time"           => $html->find('div#divQuotePageHeader span#dtaDate', 0)->plaintext,
            "TimeLocal"      => date("g:iA T"),
            "High"           => $table->find('tr', 1)->find('td', 1)->plaintext,
            "Low"            => $table->find('tr', 1)->find('td', 3)->plaintext,
            "Open"           => $table->find('tr', 3)->find('strong', 0)->plaintext,
            "Close"          => $table->find('tr', 3)->find('strong', 1)->plaintext,
            "52WHigh"        => $table->find('tr', 2)->find('span', 0)->plaintext,
            "52WLow"         => $table->find('tr', 2)->find('span', 4)->plaintext,
            "OpenInterest"   => $table->find('tr', 4)->find('strong', 0)->plaintext,
            "WeightedAlpha"  => $table->find('tr', 5)->find('strong', 0)->plaintext,
            "StandartDev"    => $table->find('tr', 5)->find('strong', 1)->plaintext,
            "20DAverage"     => $table->find('tr', 6)->find('strong', 0)->plaintext,
            "100DAverage"    => $table->find('tr', 6)->find('strong', 1)->plaintext,
            "14DRelStrength" => $table->find('tr', 7)->find('strong', 0)->plaintext,
            "14DStochastic"  => $table->find('tr', 7)->find('strong', 1)->plaintext,
            "Trend"          => $table->find('tr', 8)->find('td', 1)->plaintext,
            "TrendStrength"  => $table->find('tr', 8)->find('td', 3)->plaintext,
            "UnixTime"       => time(),
        );

        // Специфические поля для различных типов контрактов
        if ($type == 1) {
            $priceArray['Volume'] = $table->find('tr', 4)->find('td#dtaVolume', 0)->plaintext;
            $priceArray['Expiration'] = $month . "." . $year;
        } elseif ($type == 2) {
            $priceArray['AvgVolume'] = $priceArray['OpenInterest'];
            unset($priceArray['AvgVolume']);
        }

        // Очистка данных от лишних пробелов
        $priceArray = $this->trimArray($priceArray);

        // Индикаторы
        $this->tableTech = $htmlTechnical->find('div.mpbox', 1)->find('table', 0);

        // Наполнение массива с индикаторами
        $technicalDataArray = array();
        $technicalDataArray = $this->parseShortTermIndicators($technicalDataArray);
        $technicalDataArray = $this->parseMidTermIndicators($technicalDataArray);
        $technicalDataArray = $this->parseLongTermIndicators($technicalDataArray);
        $technicalDataArray = $this->parseOverallIndicators($technicalDataArray);

        $priceArray = array_merge($priceArray, $this->purifyArray($technicalDataArray));

        return $priceArray;
    }

    /**
     * Парсинг краткосрочных (суммарных) индикаторов
     * @param array $technicalDataArray
     * @return array
     */
    protected function parseShortTermIndicators($technicalDataArray = array()) {
        $technicalDataArray["s.7-AD"] = $this->parseIndicator(4);
        $technicalDataArray["s.10-8-MAHiloChannel"] = $this->parseIndicator(5);
        $technicalDataArray["s.20-MAvsPrice"] = $this->parseIndicator(6);
        $technicalDataArray["s.20-50-MACD"] = $this->parseIndicator(7);
        $technicalDataArray["s.20-Bollinger"] = $this->parseIndicator(8);

        return $technicalDataArray;
    }

    /**
     * Парсинг среднесрочных (суммарных) индикаторов
     * @param array $technicalDataArray
     * @return array
     */
    protected function parseMidTermIndicators($technicalDataArray = array()) {
        // Среднесрочные индикаторы
        $technicalDataArray["m.40-CCI"] = $this->parseIndicator(14);
        $technicalDataArray["m.50-MAvsPrice"] = $this->parseIndicator(15);
        $technicalDataArray["m.20-100-MACD"] = $this->parseIndicator(16);
        $technicalDataArray["m.50-ParabolicTimePrice"] = $this->parseIndicator(17);

        return $technicalDataArray;
    }

    /**
     * Парсинг долгосрочных (суммарных) индикаторов
     * @param array $technicalDataArray
     * @return array
     */
    protected function parseLongTermIndicators($technicalDataArray = array()) {
        // Долгосрочные индикаторы
        $technicalDataArray["l.60-CCI"] = $this->parseIndicator(23);
        $technicalDataArray["l.100-MAvsPrice"] = $this->parseIndicator(24);
        $technicalDataArray["l.50-100-MACD"] = $this->parseIndicator(25);

        return $technicalDataArray;
    }

    /**
     * Парсинг общих (суммарных) индикаторов
     * @param array $technicalDataArray
     * @return array
     */
    protected function parseOverallIndicators($technicalDataArray = array()) {
        $technicalDataArray["TrendSpotter"] = $this->parseIndicator(1);
        $shortTermAverage = explode("&nbsp;", trim($this->tableTech->find('tr', 10)->find('td', 0)->plaintext));
        $technicalDataArray["ShortTermAverage"] = array($shortTermAverage[1]);
        $midTermAverage = explode("&nbsp;", trim($this->tableTech->find('tr', 19)->find('td', 0)->plaintext));
        $technicalDataArray["MidTermAverage"] = array($midTermAverage[1]);
        $longTermAverage = explode("&nbsp;", trim($this->tableTech->find('tr', 27)->find('td', 0)->plaintext));
        $technicalDataArray["LongTermAverage"] = array($longTermAverage[1]);
        $overallAverate = explode("&nbsp;", trim($this->tableTech->find('tr', 30)->find('td', 0)->plaintext));
        $technicalDataArray["OverallAverage"] = array($overallAverate[1]);

        return $technicalDataArray;
    }

    /**
     * Очистка массива от лишних пробелов
     * @param array $array
     * @return array
     */
    protected function trimArray($array = array()) {
        foreach ($array as $key => $value) {
            $array[$key] = trim(preg_replace("/\s+/", " ", $array[$key]));
        }

        return $array;
    }

    /**
     * Очистка массивов от лишних данных, пересборка массива
     * @param array $array
     * @return array
     */
    protected function purifyArray($array = array()) {
        $pureArray = array();
        foreach ($array as $indicatorName => $indicatorValue) {
            foreach ($indicatorValue as $key => $value) {
                if ($value == '&nbsp;') {
                    unset($array[$indicatorName][$key]);
                } else {
                    $pureArray[$indicatorName] = $value;
                }
            }
        }

        return $pureArray;
    }

    /**
     * Создание объекта сущности символа и сохранение его в БД
     * @param     $symbolName
     * @param     $symbol
     * @param int $type
     * @internal param $entityName
     * @return bool
     */
    public function savePrice($symbolName, $symbol, $type) {
        $symbolData = $this->getPrice($symbol, $type);

        $symbolNamespacedName = "Rottenwood\\BarchartBundle\\Entity\\" . $symbolName;
        $symbolRepositoryName = "RottenwoodBarchartBundle:" . $symbolName;

        // Получение последней зафиксированной цены в БД для данного символа
        /** @var Price $lastSymbolObject */
        $lastPrice = $this->em->getRepository($symbolRepositoryName)->findLastPriceOfSymbol();

        // Текущая цена символа
        $price = $this->goodify($symbolData["Price"]);

        // Если цена не изменилась
        if ($lastPrice == $price) {
            return false;
        }

        $symbolEntity = new $symbolNamespacedName();

        $symbolEntity->setType($type);
        $symbolEntity->setSymbol($symbolData["Symbol"]);
        $symbolEntity->setTitle($symbolData["Title"]);
        $symbolEntity->setPrice($price);
        $symbolEntity->setCommodity($symbolData["Commodity"]);
        $symbolEntity->setExpiration($symbolData["Expiration"]);
        $symbolEntity->setDate($symbolData["Date"]);
        $symbolEntity->setTime($symbolData["Time"]);
        $symbolEntity->setTimelocal($symbolData["TimeLocal"]);
        $symbolEntity->setUnixtime($symbolData["UnixTime"]);
        $symbolEntity->setHigh($this->goodify($symbolData["High"]));
        $symbolEntity->setLow($this->goodify($symbolData["Low"]));
        $symbolEntity->setOpen($this->goodify($symbolData["Open"]));
        $symbolEntity->setClose($this->goodify($symbolData["Close"]));
        $symbolEntity->setFivetwoweekhigh($this->goodify($symbolData["52WHigh"]));
        $symbolEntity->setFivetwoweeklow($this->goodify($symbolData["52WLow"]));
        $symbolEntity->setVolume($this->goodify($symbolData["Volume"]));
        $symbolEntity->setOpeninterest($this->goodify($symbolData["OpenInterest"]));
        $symbolEntity->setWeightedalpha($this->antiPlus($symbolData["WeightedAlpha"]));
        $symbolEntity->setStandartdev($this->antiPlus($symbolData["StandartDev"]));
        $symbolEntity->setTwentydaverage($this->goodify($symbolData["20DAverage"]));
        $symbolEntity->setHundreddaverage($this->goodify($symbolData["100DAverage"]));
        $symbolEntity->setFourteendrelstrength($this->goodify($symbolData["14DRelStrength"]));
        $symbolEntity->setFourteendstochastic($this->goodify($symbolData["14DStochastic"]));
        $symbolEntity->setTrend($this->buySellToInt($symbolData["Trend"]));
        $symbolEntity->setTrendstrength($symbolData["TrendStrength"]);

        // индикаторы
        $symbolEntity->setAd($this->buySellToInt($symbolData["s.7-AD"]));
        $symbolEntity->setBollinger($this->buySellToInt($symbolData["s.20-Bollinger"]));
        $symbolEntity->setLCci($this->buySellToInt($symbolData["l.60-CCI"]));
        $symbolEntity->setLMacd($this->buySellToInt($symbolData["l.50-100-MACD"]));
        $symbolEntity->setLMavp($this->buySellToInt($symbolData["l.100-MAvsPrice"]));
        $symbolEntity->setMCci($this->buySellToInt($symbolData["m.40-CCI"]));
        $symbolEntity->setMMacd($this->buySellToInt($symbolData["m.20-100-MACD"]));
        $symbolEntity->setMMavp($this->buySellToInt($symbolData["m.50-MAvsPrice"]));
        $symbolEntity->setMahilo($this->buySellToInt($symbolData["s.10-8-MAHiloChannel"]));
        $symbolEntity->setParabolic($this->buySellToInt($symbolData["m.50-ParabolicTimePrice"]));
        $symbolEntity->setSMacd($this->buySellToInt($symbolData["s.20-50-MACD"]));
        $symbolEntity->setSMavp($this->buySellToInt($symbolData["s.20-MAvsPrice"]));
        $symbolEntity->setTrendspotter($this->buySellToInt($symbolData["TrendSpotter"]));
        $symbolEntity->setSAverage($this->buySellProcToInt($symbolData["ShortTermAverage"]));
        $symbolEntity->setMAverage($this->buySellProcToInt($symbolData["MidTermAverage"]));
        $symbolEntity->setLAverage($this->buySellProcToInt($symbolData["LongTermAverage"]));
        $symbolEntity->setOverall($this->buySellProcToInt($symbolData["OverallAverage"]));

        $this->em->persist($symbolEntity);
        $this->em->flush();

        return true;
    }

    /**
     * Парсинг и сохранение в БД цен массива символов
     * @param array $symbols
     * @param int   $type
     * @return bool
     */
    protected function saveAllPrices($symbols, $type) {
        foreach ($symbols as $symbolName => $symbol) {
            $this->savePrice($symbolName, $symbol, $type);
        }

        return true;
    }

    public function saveAllForex() {
        $type = 2; // тип контракта - валютная пара

        $urlsAllForex = $this->config["url"]["forex"];

        $this->savePrice('GBPUSD', 'GBPUSD', $type);
    }

    /**
     * Парсинг и сохранение в БД основных фьючерсов
     * @return bool
     */
    public function saveAllFutures() {
        $type = 1; // тип контракта - фьючерс
        $futures = $this->parseActualFutures();

        $this->saveAllPrices($futures, $type);

        return true;
    }

    private function parseActualFutures() {
        $urlAllFutures = $this->config["url"]["futuresall"];

        $html = HtmlDomParser::file_get_html($urlAllFutures);

        // Обработка таблицы фьючерсов
        $tableEnergies = $html->find('table#dt2 tbody', 0);
        $symbols['CrudeOil'] = $tableEnergies->find('tr', 1)->find('td', 1)->plaintext;
        $symbols['NaturalGas'] = $tableEnergies->find('tr', 4)->find('td', 1)->plaintext;

        $tableGrains = $html->find('table#dt4 tbody', 0);
        $symbols['Wheat'] = $tableGrains->find('tr', 1)->find('td', 1)->plaintext;
        $symbols['Corn'] = $tableGrains->find('tr', 2)->find('td', 1)->plaintext;
        $symbols['Soybeans'] = $tableGrains->find('tr', 3)->find('td', 1)->plaintext;

        $tableIndexes = $html->find('table#dt5 tbody', 0);
        $symbols['Emini'] = $tableIndexes->find('tr', 1)->find('td', 1)->plaintext;
        $symbols['DJMini'] = $tableIndexes->find('tr', 3)->find('td', 1)->plaintext;

        $tableMetals = $html->find('table#dt7 tbody', 0);
        $symbols['Gold'] = $tableMetals->find('tr', 1)->find('td', 1)->plaintext;
        $symbols['Silver'] = $tableMetals->find('tr', 2)->find('td', 1)->plaintext;

        // Приведение символов к нужному виду
        foreach ($symbols as $key => $symbol) {
            $symbols[$key] = explode(' ', $symbol);
            $symbols[$key] = $symbols[$key][0];
            $lastTwoSymbols = substr($symbols[$key], -2);
            $lastSymbol = substr($lastTwoSymbols, 1);
            $symbolsString = substr($symbols[$key], 0, -2);
            $symbols[$key] = $symbolsString . $lastSymbol;
        }

        return $symbols;
    }

    public function goodify($price) {
        $price = preg_replace('/(%)/', '', $price);
        $price = preg_replace('/(,)/', '', $price);
        $price = preg_replace('/(s)/', '', $price);
        if (preg_match('/([-.])/', $price)) {
            $priceInt = preg_replace('/([-.])(.*)/', '', $price);
            $priceFloat = preg_replace('/(.*)([-.])/', '', $price);
            $price = $priceInt . '.' . $priceFloat;
        }

        return (float)$price;
    }

    public function antiPlus($value) {
        if (preg_match('/([+])/', $value)) {
            $value = preg_replace('/([+])/', '', $value);
        }

        return (float)$value;
    }

    public function buySellToInt($value) {
        switch ($value) {
            default:
                // Добавить сюда логирование иного сигнала
                $indicatorDirection = 0;
                break;
            case 'Buy':
                $indicatorDirection = 1;
                break;
            case 'Sell':
                $indicatorDirection = -1;
                break;
            case 'Hold':
                $indicatorDirection = 0;
                break;
        }

        return $indicatorDirection;
    }

    public function buySellProcToInt($value) {
        $buySell = preg_replace('/(.*)(\s)/', '', $value);

        $indicatorDirection = $this->buySellToInt($buySell);

        if ($indicatorDirection) {
            $indicatorStrengthProc = preg_replace('/%(\s)(.*)/', '', $value);
        } else {
            $indicatorStrengthProc = 0;
        }

        $indicatorValueInt = $indicatorStrengthProc * $indicatorDirection;

        return (int)$indicatorValueInt;
    }
}
