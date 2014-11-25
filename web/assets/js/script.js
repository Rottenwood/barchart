$(document).ready(function () {

///////////////////////////////////////////////
////                                       ////
////              Переменные               ////
////                                       ////
///////////////////////////////////////////////

    // Форма создания стратегии
    if ($('div#strategy').length) {
        $('button#strategy_addSignal').on("click", function () {
            addSignal();
        });

    }

    $('button.addIndicator').on("click", function (event) {
        console.log('test');
        addIndicator($(event.target).parent('div').prev('div').children('div'));
    });


///////////////////////////////////////////////
////                                       ////
////                События                ////
////                                       ////
///////////////////////////////////////////////


///////////////////////////////////////////////
////                                       ////
////         Запускаемые процедуры         ////
////                                       ////
///////////////////////////////////////////////


});

///////////////////////////////////////////////
////                                       ////
////                Функции                ////
////                                       ////
///////////////////////////////////////////////

///// Формы

// Отрисовка формы сигнала
function addSignal() {
    var $strategySignals = $('div#strategy-signals'),
        prototype = $strategySignals.closest('[data-prototype]'),
        id = $(prototype).attr('id'),
        newSignalDiv = $(prototype).data('prototype');

    $strategySignals.append(newSignalDiv);
}

// Отрисовка формы индикатора
function addIndicator($div) {
    var $signalIndicators = $('div#strategy-signals div[id$="_indicators"]'),
        prototype = $('div#strategy-signals').closest('[data-prototype-indicators]'),
        id = $(prototype).attr('id'),
        newIndicatorDiv = $(prototype).data('prototype');

    $div.append('<p>test</p>');
}

