<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/home/wwwroot/www.gcan.top/blog/public/../application/index/view/index/firstcny.html";i:1501832386;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Metronic | The Ultimate Multi-purpose Bootstrap Admin Dashboard Theme | Theme #3 | HighStock</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #3 for Lorem ipsum"
          name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="__STATIC__/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="__STATIC__/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="__STATIC__/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="__STATIC__/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-container-bg-solid">



<div style="display: none;" class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Compare Multiple Series</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="highstock_1" style="height:500px;"></div>
            </div>
        </div>
    </div>
</div>


<div id="highstock_2" style="height:500px;"></div>















<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="__STATIC__/assets/global/plugins/respond.min.js"></script>
<script src="__STATIC__/assets/global/plugins/excanvas.min.js"></script>
<script src="__STATIC__/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="__STATIC__/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="__STATIC__/assets/global/plugins/highstock/js/highstock.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="__STATIC__/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--<script src="__STATIC__/assets/pages/scripts/charts-highstock.min.js" type="text/javascript"></script>-->
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="__STATIC__/assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="__STATIC__/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->



<script>

    jQuery(document).ready(function() {
        // HIGHSTOCK DEMOS

        // COMPARE MULTIPLE SERIES
        var seriesOptions = [],
            seriesCounter = 0,
            names = ['MSFT', 'AAPL', 'GOOG'],
            // create the chart when all data is loaded
            createChart = function () {

                $('#highstock_1').highcharts('StockChart', {
                    chart : {
                        style: {
                            fontFamily: 'Open Sans'
                        }
                    },

                    rangeSelector: {
                        selected: 4
                    },

                    yAxis: {
                        labels: {
                            formatter: function () {
                                return (this.value > 0 ? ' + ' : '') + this.value + '%';
                            }
                        },
                        plotLines: [{
                            value: 0,
                            width: 2,
                            color: 'silver'
                        }]
                    },

                    plotOptions: {
                        series: {
                            compare: 'percent'
                        }
                    },

                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
                        valueDecimals: 2
                    },

                    series: seriesOptions
                });
            };

        $.each(names, function (i, name) {

            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=' + name.toLowerCase() + '-c.json&callback=?',    function (data) {

                seriesOptions[i] = {
                    name: name,
                    data: data
                };

                // As we're loading the data asynchronously, we don't know what order it will arrive. So
                // we keep a counter and create the chart when all the data is loaded.
                seriesCounter += 1;

                if (seriesCounter === names.length) {
                    createChart();
                }
            });
        });

        // CANDLESTICK CHART
//        $.getJSON('http://www.gcan.top/blog/public/index/index/firstcny_trade_msg', function (data) {
            $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {


            console.log(data);

            // split the data set into ohlc and volume
            var ohlc = [],
                volume = [],
                dataLength = data.length,
                // set the allowed units for data grouping
                groupingUnits = [[
                    'week',                         // unit name
                    [1]                             // allowed multiples
                ], [
                    'month',
                    [1, 2, 3, 4, 6]
                ]],

                i = 0;
            console.log(groupingUnits);
            console.log(ohlc);

            for (i; i < dataLength; i += 1) {
//                ohlc.push([
//                    data[i][0], // the date
//                    data[i][1], // open
//                    data[i][2], // high
//                    data[i][3], // low
//                    data[i][4] // close
//                ]);
                ohlc.push([
                    data[i][0], // the date
                    data[i][1], // open
                    data[i][2], // high
                    data[i][3], // low
                    data[i][4] // close
                ]);


                volume.push([
                    data[i][0], // the date
                    data[i][5] // the volume
                ]);
            }


            // create the chart
            $('#highstock_2').highcharts('StockChart', {
                chart : {
                    style: {
                        fontFamily: 'Open Sans'
                    }
                },

                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'AAPL Historical'
                },

                yAxis: [{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'OHLC'
                    },
                    height: '60%',
                    lineWidth: 2
                }, {
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Volume'
                    },
                    top: '65%',
                    height: '35%',
                    offset: 0,
                    lineWidth: 2
                }],

                series: [{
                    type: 'candlestick',
                    name: 'AAPL',
                    data: ohlc,
                    dataGrouping: {
                        units: groupingUnits
                    }
                }, {
                    type: 'column',
                    name: 'Volume',
                    data: volume,
                    yAxis: 1,
                    dataGrouping: {
                        units: groupingUnits
                    }
                }]
            });
        });

        // OHLC CHART
        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlc.json&callback=?', function (data) {

            // create the chart
            $('#highstock_3').highcharts('StockChart', {
                chart : {
                    style: {
                        fontFamily: 'Open Sans'
                    }
                },

                rangeSelector : {
                    selected : 2
                },

                title : {
                    text : 'AAPL Stock Price'
                },

                series : [{
                    type : 'ohlc',
                    name : 'AAPL Stock Price',
                    data : data,
                    dataGrouping : {
                        units : [[
                            'week', // unit name
                            [1] // allowed multiples
                        ], [
                            'month',
                            [1, 2, 3, 4, 6]
                        ]]
                    }
                }]
            });
        });

        // LINE CHART WITH FLAGS
        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {

            var year = new Date(data[data.length - 1][0]).getFullYear(); // Get year of last data point

            // Create the chart
            $('#highstock_4').highcharts('StockChart', {
                chart : {
                    style: {
                        fontFamily: 'Open Sans'
                    }
                },

                rangeSelector: {
                    selected: 1
                },

                title: {
                    text: 'USD to EUR exchange rate'
                },

                yAxis: {
                    title: {
                        text: 'Exchange rate'
                    }
                },

                series: [{
                    name: 'USD to EUR',
                    data: data,
                    id: 'dataseries',
                    tooltip: {
                        valueDecimals: 4
                    }
                }, {
                    type: 'flags',
                    data: [{
                        x: Date.UTC(year, 1, 22),
                        title: 'A',
                        text: 'Shape: "squarepin"'
                    }, {
                        x: Date.UTC(year, 3, 28),
                        title: 'A',
                        text: 'Shape: "squarepin"'
                    }],
                    onSeries: 'dataseries',
                    shape: 'squarepin',
                    width: 16
                }, {
                    type: 'flags',
                    data: [{
                        x: Date.UTC(year, 2, 1),
                        title: 'B',
                        text: 'Shape: "circlepin"'
                    }, {
                        x: Date.UTC(year, 3, 1),
                        title: 'B',
                        text: 'Shape: "circlepin"'
                    }],
                    shape: 'circlepin',
                    width: 16
                }, {
                    type: 'flags',
                    data: [{
                        x: Date.UTC(year, 2, 10),
                        title: 'C',
                        text: 'Shape: "flag"'
                    }, {
                        x: Date.UTC(year, 3, 11),
                        title: 'C',
                        text: 'Shape: "flag"'
                    }],
                    color: Highcharts.getOptions().colors[0], // same as onSeries
                    fillColor: Highcharts.getOptions().colors[0],
                    onSeries: 'dataseries',
                    width: 16,
                    style: { // text style
                        color: 'white'
                    },
                    states: {
                        hover: {
                            fillColor: '#395C84' // darker
                        }
                    }
                }]
            });
        });

    });


</script>










</body>

</html>