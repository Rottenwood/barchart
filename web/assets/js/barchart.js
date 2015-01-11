/**
 * Created by petr on 11.01.15.
 */

$(document).ready(function () {
    var config = {
        'eachTrades': 30,
        'eachTradesCheck': 30
    };

    var chartBacktestCanvas = $("#chart-backtest").get(0).getContext("2d");

    var $trades = $('#trades-list tbody').find('tr');
    var tradesCount = $trades.length;
    var dates = [];
    var balanceArray = [];

    if (tradesCount > config.eachTradesCheck) {
        var tradesCountOptimal = Math.round(tradesCount / config.eachTrades);

        $trades.each(function (key, value) {
            if (key % tradesCountOptimal == 0) {
                var date = $(value).find('td.close-date').data('date');
                var balance = Math.floor($(value).find('td.profit-local span').text());

                if (date) {
                    dates.push(date);
                    balanceArray.push(balance);
                }
            }
        });
    } else {
        $trades.each(function (key, value) {
            var date = $(value).find('td.close-date').data('date');
            var balance = Math.floor($(value).find('td.profit-local span').text());

            if (date) {
                dates.push(date);
                balanceArray.push(balance);
            }
        });
    }

    var data = {
        labels: dates,
        datasets: [
            {
                label: "Strategy Backtest",
                fillColor: "rgba(116, 205, 155, 0.4)",
                strokeColor: "#74cd9b",
                pointColor: "#74cd9b",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#74cd9b",
                data: balanceArray
            }
        ]
    };

    var backTestChart = new Chart(chartBacktestCanvas).Line(data, {
        pointDotRadius: 6,
        pointHitDetectionRadius: 5
    });

    //backTestChart.addData([45], "August");
    //backTestChart.addData([50], "Sept");
    //backTestChart.addData([55], "Ppp");
    // Would update the first dataset's value of 'March' to be 50
    //backTestChart.update();
});