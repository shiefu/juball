<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/template/starball/Skin/bootstrap-3.3.7/css/bootstrap.min.css">
    <script src="/template/starball/Skin/js/jquery-1.12.4.min.js"></script>
    <script src="/template/starball/Skin/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/highcharts.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/modules/data.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/modules/exporting.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/themes/sand-signika.js"></script>

    <script type="text/javascript">

        function getDigit(){
            if (!localStorage.getItem('digit')){
                return 'w';
            }else{
                return localStorage.getItem('digit');
            }
        }

        function getPlan(){
            if (!localStorage.getItem('plan')){
                return 'a';
            }else{
                return localStorage.getItem('plan');
            }
        }

        function data_chart(){
            var digit = getDigit();

            $.ajax({
                //url: './getLiveData.php?c=cqssc&a=yilou_analysis_show',
                url: './getLiveData.php?c=cqssc&a=yilou_latest_show',
                type: 'post',
                data: "digit="+digit,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error:function(){
                    alert('目前系統異常或忙碌中，請稍後再試。');
                },
                success: function(data){
                    /*$('#container').highcharts({
                        title: {
                            text: '遗漏值分析走势图',
                            x: -20 //center
                        },
                        subtitle: {
                            text: 'Number Analysis Chart',
                            x: -20
                        },
                        xAxis: {
                            title: {
                                text: '号码'
                            },
                            categories: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
                        },
                        yAxis: {
                            title: {
                                text: '遗漏值'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            headerFormat: '<b>号码：{point.x}</b><br>',
                        },
                        plotOptions: {
                            spline: {
                                marker: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'horizontal',
                            verticalAlign: 'bottom',
                            borderWidth: 0
                        },
                        global: {
                            timezoneOffset: +8 * 60  // +8 時區
                        },
                        lang:{
                            contextButtonTitle:"图表导出菜单",
                            downloadJPEG:"下载JPEG图片",
                            downloadPDF:"下载PDF文件",
                            downloadPNG:"下载PNG图片",
                            downloadSVG:"下载SVG文件",
                            drillUpText:"返回 {series.name}",
                            loading:"加载中",
                            noData:"没有数据",
                            printChart:"打印图表",
                            resetZoom:"恢复缩放",
                            resetZoomTitle:"恢复图表",
                        },
                        series: data
                    });*/
                    console.log(data);
                }
            });
        };

        $(function () {
            $('#container').highcharts({
                title: {
                    text: '遗漏值分析走势图',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Number Analysis Chart',
                    x: -20
                },
                xAxis: {
                    title: {
                        text: '号码'
                    },
                    categories: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
                },
                yAxis: {
                    title: {
                        text: '遗漏值'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    headerFormat: '<b>号码：{point.x}</b><br>',
                },
                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'horizontal',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                global: {
                    timezoneOffset: +8 * 60  // +8 時區
                },
                lang:{
                    contextButtonTitle:"图表导出菜单",
                    downloadJPEG:"下载JPEG图片",
                    downloadPDF:"下载PDF文件",
                    downloadPNG:"下载PNG图片",
                    downloadSVG:"下载SVG文件",
                    drillUpText:"返回 {series.name}",
                    loading:"加载中",
                    noData:"没有数据",
                    printChart:"打印图表",
                    resetZoom:"恢复缩放",
                    resetZoomTitle:"恢复图表",
                },
                series: [{
                    name: '当前遗漏',
                    data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3]
                }, {
                    name: '20期',
                    data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1]
                }, {
                    name: '60期遗漏',
                    data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0]
                }, {
                    name: '120期遗漏',
                    data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3]
                }]
            });
        });

    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <button onclick="data_chart();">data_chart</button>
        </div>
        <div class="row">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</body>

</html>