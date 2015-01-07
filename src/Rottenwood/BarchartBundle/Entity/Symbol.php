<?php

namespace Rottenwood\BarchartBundle\Entity;

/**
 * Торговые символы
 */
abstract class Symbol {

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
     * Получение массива названий сущностей для торговых символов
     * @return array
     */
    public static function getSymbolName() {
        return array(
            self::SYMBOL_FUTURES_CORN       => 'Corn',
            self::SYMBOL_FUTURES_CRUDEOIL   => 'CrudeOil',
            self::SYMBOL_FUTURES_DJMINI     => 'DJMini',
            self::SYMBOL_FUTURES_EMINI      => 'Emini',
            self::SYMBOL_FUTURES_GOLD       => 'Gold',
            self::SYMBOL_FUTURES_NATURALGAS => 'NaturalGas',
            self::SYMBOL_FUTURES_SILVER     => 'Silver',
            self::SYMBOL_FUTURES_SOYBEANS   => 'Soybeans',
            self::SYMBOL_FUTURES_WHEAT      => 'Wheat',

            self::SYMBOL_FOREX_AUDUSD       => 'AUDUSD',
            self::SYMBOL_FOREX_EURUSD       => 'EURUSD',
            self::SYMBOL_FOREX_GBPUSD       => 'GBPUSD',
            self::SYMBOL_FOREX_USDCAD       => 'USDCAD',
            self::SYMBOL_FOREX_USDCHF       => 'USDCHF',
            self::SYMBOL_FOREX_USDJPY       => 'USDJPY',
        );
    }

    /**
     * Получение массива русских названий сущностей для торговых символов
     * @return array
     */
    public static function getRussianSymbolName() {
        return array(
            self::SYMBOL_FUTURES_CORN       => 'Кукуруза',
            self::SYMBOL_FUTURES_CRUDEOIL   => 'Нефть марки WTI',
            self::SYMBOL_FUTURES_DJMINI     => 'Индекс DowJones mini',
            self::SYMBOL_FUTURES_EMINI      => 'Индекс S&P mini',
            self::SYMBOL_FUTURES_GOLD       => 'Золото',
            self::SYMBOL_FUTURES_NATURALGAS => 'Природный газ',
            self::SYMBOL_FUTURES_SILVER     => 'Серебро',
            self::SYMBOL_FUTURES_SOYBEANS   => 'Соевые бобы',
            self::SYMBOL_FUTURES_WHEAT      => 'Пшеница',

            self::SYMBOL_FOREX_AUDUSD       => 'Австралийский доллар к Доллару США',
            self::SYMBOL_FOREX_EURUSD       => 'Евро к Доллару США',
            self::SYMBOL_FOREX_GBPUSD       => 'Британский фунт к Доллару США',
            self::SYMBOL_FOREX_USDCAD       => 'Доллар США к Канадскому доллару',
            self::SYMBOL_FOREX_USDCHF       => 'Доллар США к Швейцарскому франку',
            self::SYMBOL_FOREX_USDJPY       => 'Доллар США к Японской йене',
        );
    }
}
