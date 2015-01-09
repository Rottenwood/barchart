$(document).ready(function () {
    vars = {
        indicatorsCount: {}
    };

    // Форма создания стратегии
    if ($('div#strategy').length) {
        $('button#strategy_addSignal').off("click").on("click", function () {
            addSignal();
        });

        bindIndicatorEvent();
    }
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
        newSignalDiv = $(prototype).data('prototype').replace(/strategy_signals___name__/g, 'strategy_signals_' + $strategySignals.children().length).replace(/\[signals\]\[__name__\]/g, '[signals][' + $strategySignals.children().length + ']');

    $strategySignals.append(newSignalDiv);
    bindIndicatorEvent();
}

// Отрисовка формы индикатора
function addIndicator($div) {
    var $signalIndicators = $('div#strategy-signals div[id$="_indicatorValues"]'),
        prototype = $div.data('prototype'),
        newIndicatorDiv = prototype.replace(/<label class="required">__name__label__<\/label>/g, '').replace(/__name__/g, $signalIndicators.children().length);

    $div.append(newIndicatorDiv);
    bindIndicatorEvent();
}

// Добавление и удаление индикатора
function bindIndicatorEvent() {
    $('button.addIndicator').off("click").on("click", function (event) {
        addIndicator($(event.target).parent('div').prev('div').children('div'));
    });

    $('button.deleteIndicator').off("click").on("click", function (event) {
        $(event.target).parent('div').parent('div').remove();
    });

    $('button.deleteSignal').off("click").on("click", function (event) {
        $(event.target).parent('div').parent('div').remove();
    });
}

// Добавление и удаление сигнала
function bindSignalEvent() {
    $('button.deleteSignal').off("click").on("click", function (event) {
        $(event.target).parent('div').parent('div').remove();
    });
}
