<?php
/**
 * Author: Rottenwood
 * Date Created: 05.09.14 17:42
 */

namespace Rottenwood\BarchartBundle\Service;
use Doctrine\ORM\EntityManager;
use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Yaml\Yaml;

/**
 * Парсер данных с сайта barchart.com
 * @date 08.09.2014
 * @package Rottenwood\BarchartBundle\Service
 */
class BarchartParserService {
    private $em;
    private $kernel;
    private $config;
    private $tableTech;

    public function __construct(EntityManager $em, Kernel $kernel) {
        $this->em = $em;
        $this->kernel = $kernel;
        $this->config = $this->configLoad();
    }

    /**
     * Загрузка файла конфигурации (barchart.yml)
     * @return array
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    protected function configLoad() {
        $path = $this->kernel->locateResource("@RottenwoodBarchartBundle/Resources/config/barchart.yml");
        if (!is_string($path)) {
            throw new Exception("$path должен быть строкой.");
        }
        $config = Yaml::parse(file_get_contents($path));

        return $config;
    }

    /**
     * Получение кода страницы с помощью HtmlDomParser
     * @param $url
     * @param $symbol
     * @return mixed
     */
    protected function parsePage($url, $symbol) {
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
     * @param $symbol
     * @return array
     */
    protected function getPrice($symbol) {
        $url = $this->config["url"]["price"];
        $urlTechnical = $this->config["url"]["technical"];

        $html = $this->parsePage($url, $symbol);
        $htmlTechnical = $this->parsePage($urlTechnical, $symbol);

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
            "Symbol" => $symbol,
            "Title" => $title,
            "Price" => $html->find('div#divQuotePageHeader span#dtaLast', 0)->plaintext,
            "Commodity" => $titleArray[0],
            "Expiration" => $month . "." . $year,
            "Date" => date("m.Y"),
            "Time" => $html->find('div#divQuotePageHeader span#dtaDate', 0)->plaintext,
            "TimeLocal" => date("g:iA T"),
            "High" => $table->find('tr', 1)->find('td', 1)->plaintext,
            "Low" => $table->find('tr', 1)->find('td', 3)->plaintext,
            "Open" => $table->find('tr', 3)->find('strong', 0)->plaintext,
            "Close" => $table->find('tr', 3)->find('strong', 1)->plaintext,
            "52WHigh" => $table->find('tr', 2)->find('span', 0)->plaintext,
            "52WLow" => $table->find('tr', 2)->find('span', 4)->plaintext,
            "Volume" => $table->find('tr', 4)->find('td#dtaVolume', 0)->plaintext,
            "OpenInterest" => $table->find('tr', 4)->find('strong', 0)->plaintext,
            "WeightedAlpha" => $table->find('tr', 5)->find('strong', 0)->plaintext,
            "StandartDev" => $table->find('tr', 5)->find('strong', 1)->plaintext,
            "20DAverage" => $table->find('tr', 6)->find('strong', 0)->plaintext,
            "100DAverage" => $table->find('tr', 6)->find('strong', 1)->plaintext,
            "14DRelStrength" => $table->find('tr', 7)->find('strong', 0)->plaintext,
            "14DStochastic" => $table->find('tr', 7)->find('strong', 1)->plaintext,
            "Trend" => $table->find('tr', 8)->find('td', 1)->plaintext,
            "TrendStrength" => $table->find('tr', 8)->find('td', 3)->plaintext,
            "UnixTime" => time(),
        );

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
     * @param $symbol
     * @return bool
     */
    public function savePrice($symbol) {
        $symbolName = $this->symbolName($symbol);
        $symbolData = $this->getPrice($symbol);

        $symbolNamespacedName = "Rottenwood\\BarchartBundle\\Entity\\" . $symbolName;
        $symbolEntity = new $symbolNamespacedName();

        $symbolEntity->setType(1);
        $symbolEntity->setSymbol($symbolData["Symbol"]);
        $symbolEntity->setTitle($symbolData["Title"]);
        $symbolEntity->setPrice($symbolData["Price"]);
        $symbolEntity->setCommodity($symbolData["Commodity"]);
        $symbolEntity->setExpiration($symbolData["Expiration"]);
        $symbolEntity->setDate($symbolData["Date"]);
        $symbolEntity->setTime($symbolData["Time"]);
        $symbolEntity->setTimelocal($symbolData["TimeLocal"]);
        $symbolEntity->setUnixtime($symbolData["UnixTime"]);
        $symbolEntity->setHigh($symbolData["High"]);
        $symbolEntity->setLow($symbolData["Low"]);
        $symbolEntity->setOpen($symbolData["Open"]);
        $symbolEntity->setClose($symbolData["Close"]);
        $symbolEntity->setFivetwoweekhigh($symbolData["52WHigh"]);
        $symbolEntity->setFivetwoweeklow($symbolData["52WLow"]);
        $symbolEntity->setVolume($symbolData["Volume"]);
        $symbolEntity->setOpeninterest($symbolData["OpenInterest"]);
        $symbolEntity->setWeightedalpha($symbolData["WeightedAlpha"]);
        $symbolEntity->setStandartdev($symbolData["StandartDev"]);
        $symbolEntity->setTwentydaverage($symbolData["20DAverage"]);
        $symbolEntity->setHundreddaverage($symbolData["100DAverage"]);
        $symbolEntity->setFourteendrelstrength($symbolData["14DRelStrength"]);
        $symbolEntity->setFourteendstochastic($symbolData["14DStochastic"]);
        $symbolEntity->setTrend($symbolData["Trend"]);
        $symbolEntity->setTrendstrength($symbolData["TrendStrength"]);

        // индикаторы
        $symbolEntity->setAd($symbolData["s.7-AD"]);
        $symbolEntity->setBollinger($symbolData["s.20-Bollinger"]);
        $symbolEntity->setLAverage($symbolData["LongTermAverage"]);
        $symbolEntity->setLCci($symbolData["l.60-CCI"]);
        $symbolEntity->setLMacd($symbolData["l.50-100-MACD"]);
        $symbolEntity->setLMavp($symbolData["l.100-MAvsPrice"]);
        $symbolEntity->setMAverage($symbolData["MidTermAverage"]);
        $symbolEntity->setMCci($symbolData["m.40-CCI"]);
        $symbolEntity->setMMacd($symbolData["m.20-100-MACD"]);
        $symbolEntity->setMMavp($symbolData["m.50-MAvsPrice"]);
        $symbolEntity->setMahilo($symbolData["s.10-8-MAHiloChannel"]);
        $symbolEntity->setOverall($symbolData["OverallAverage"]);
        $symbolEntity->setParabolic($symbolData["m.50-ParabolicTimePrice"]);
        $symbolEntity->setSAverage($symbolData["ShortTermAverage"]);
        $symbolEntity->setSMacd($symbolData["s.20-50-MACD"]);
        $symbolEntity->setSMavp($symbolData["s.20-MAvsPrice"]);
        $symbolEntity->setTrendspotter($symbolData["TrendSpotter"]);

        $this->em->persist($symbolEntity);
        $this->em->flush();

        return true;
    }

    /**
     * Поиск соответствия символа имени сущности
     * @param $symbol
     * @return mixed
     * @throws \Exception
     */
    protected function symbolName($symbol) {
        $symbolNames = array(
            "ESU4" => "Emini",
            "ZSX14" => "Soybeans",
            "YMU4" => "DJMini",
            "CLV4" => "CrudeOil",
            "NGV4" => "NaturalGas",
            "GCZ4" => "Gold",
            "SIZ4" => "Silver",
            "ZWZ4" => "Wheat",
            "ZCZ4" => "Corn",
        );

        if (array_key_exists($symbol, $symbolNames)) {
            $symbolName = $symbolNames[$symbol];
        } else {
            throw new \Exception("Сущность для символа $symbol не найдена");
        }

        return $symbolName;
    }

    /**
     * Парсинг и сохранение в БД цен массива символов
     * @param array $symbols
     * @return bool
     */
    protected function saveAllPrices($symbols) {
        foreach ($symbols as $symbol) {
            $this->savePrice($symbol);
        }

        return true;
    }

    /**
     * Парсинг и сохранение в БД основных фьючерсов
     * @return bool
     */
    public function saveAllFutures() {

        $symbols = array(
            "ESU4", // E-Mini SNP500
            "ZSX14", // Soybeans
            "YMU4", // DowJones Mini
            "CLV4", // Crude Oil
            "NGV4", // Natural Gas
            "GCZ4", // Gold
            "SIZ4", // Silver
            "ZWZ4", // Wheat
            "ZCZ4", // Corn
        );

        $this->saveAllPrices($symbols);

        return true;
    }

}