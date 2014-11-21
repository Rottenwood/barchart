$(document).ready(function () {

//////////////////////////////////////////////////
////                                          ////
////                Переменные                ////
////                                          ////
//////////////////////////////////////////////////

    // Форма создания стратегии
    if ($('div#strategy').length) {
        $('button#strategy_addSignal').on("click", function () {
            addSignal();
        });
    }


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

function addSignal() {
    var $strategySignals = $('div#strategy-signals'),
    prototype = $(this).closest('[data-prototype]'),
    id = $(prototype).attr('id'),
    newRow = $(prototype).data('prototype');




    $strategySignals.append(html);
}

//main.newRow = function () {
//    var prototype = $(this).closest('[data-prototype]');
//    var id = $(prototype).attr('id');
//    var newRow = $(prototype).data('prototype');
//    var allowNew = (undefined == $(prototype).data('allow-new') ? true : Boolean($(prototype).data('allow-new')));
//
//    newRow = $(newRow.replace(/__name__/g, main.rowsCount[id]));
//    main.rowsCount[id]++;
//
//    $(newRow).addClass('row').find('label').remove();
//
//    $('div', newRow).each(function (i) {
//        $(newRow).find('div:eq(' + i + ')').attr('class', $('.row-first div:eq(' + i + ')', prototype).attr('class'));
//    });
//
//    if (allowNew) {
//        $(newRow).find('div:last').after('<a class="row-add">+</a>');
//    }
//
//    $('.row a.row-add', prototype).removeClass('row-add').addClass('row-remove').text('×');
//    $('.row:last', prototype).after(newRow);
//
//    main.makeRadiosCheckboxesAndSelectsBeautiful();
//
//    return false;
//};
