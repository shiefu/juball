<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php require_once "functions.php"; ?>
    <title><?=SITE_CNAME?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="<?=SITE_CNAME?>">
    <meta name="keywords" content="">
    <!--CSS-->
    <link rel="stylesheet" href="/template/starball/Skin/css/loading.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/jquery.fancybox.css">
    <link rel="shortcut icon" href="/template/starball/Skin/images/ico/favicon-32x32.png" sizes="32x32" type="image/x-icon">
    <link rel="stylesheet" href="/template/starball/Skin/css/fontello.css" media="all">
    <link rel="stylesheet" href="/template/starball/Skin/css/animate.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/imagehover.min.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/jcountdown.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/tipsy.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/style.css">
    <link rel="stylesheet" href="/template/starball/Skin/bootstrap-3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Signika:400,700" rel="stylesheet" type="text/css">

    <style rel="stylesheet">
        .banner-background{
            background: url(/template/starball/Skin/images/slider/banner-1.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center center;
            text-align: center;
        }
        .banner-text{
            width: 80%;
            height: auto;
            margin: 0 auto 30px auto;
            padding: 0;
            color: #fff;
            font-size: 14px;
            line-height: 24px;
            text-shadow: 0px 0px 5px rgba(0, 0, 0, .2);
        }
        .equal-height > div[class*='col-'] {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex:1 0 auto;
        }
        .fancybox-margin{
            margin-right:17px;
        }
        body {
            line-height: 1.8em;
            color: #333;
            background-color: #e8e3df;
            font: 0.75em Verdana,"Microsoft YaHei", Arial, Helvetica, sans-serif;
            padding-top: 66px;
        }
    </style>
    <!--JS-->
    <script src="/template/starball/Skin/js/jquery-1.12.4.min.js"></script>
    <script src="/template/starball/Skin/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/template/starball/Skin/js/BreakingNews.js"></script>
    <script src="/template/starball/Skin/js/jquery.jcountdown.min.js"></script>
    <script src="/template/starball/Skin/js/jquery.bxslider.min.js"></script>
    <script src="/template/starball/Skin/js/jquery.tipsy.js"></script>
    <script src="/template/starball/Skin/js/plugs.js"></script>
    <script type="text/javascript">
        var site_dir="/";
    </script>
    <script src="/template/starball/Skin/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script src="/template/starball/Skin/js/jquery.fancybox.pack.js"></script>
    <script src="/template/starball/Skin/js/jquery.tablesorter.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/highcharts.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/modules/data.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/modules/exporting.js"></script>
    <script src="/template/starball/Skin/js/Highcharts/themes/sand-signika.js"></script>

    <script type="text/javascript">
        const SOURCE_DOMAIN = 'http://slcai1.com/';
        var isOpening = false;

        $(document).ready(function(){
            //試算表-設定預設選項
            var _show = 1-1;
            var $defaultLi = $('.spreadsheet-btn ul li').eq(_show).addClass('current');

            //計劃類別
            $("#category-1").on('click','li',function (){
                var category = category_ChineseToID($(this).text());;
                $(this).siblings('li').removeClass('current');
                $(this).addClass('current');
                localStorage.setItem('category', category);
                if (category == 'yilou'){
                    $('.ssc-plan').hide();
                    localStorage.setItem('categorytype', 'category_lost');
                }else{
                    $('.ssc-plan').show();
                    localStorage.setItem('categorytype', 'category_plan');
                }
                $("#digit-2 li").removeClass('current');
                $("#item-1 li").removeClass('current');
            });

            //位數選擇
            $("#digit-2").on('click','li',function (){
                var digit = digit_ChineseToID($(this).text()),
                    categorytype = getCategoryType();

                $(this).siblings('li').removeClass('current');
                $(this).addClass('current');
                $("#item-1 li").removeClass('current');
                localStorage.setItem('digit', digit);
                if (categorytype === 'category_lost'){
                    location.reload();
                }
            });

            //計劃選擇
            $("#item-1").on('click','li',function (){
                var plan;
                //$(".loading").fadeIn(500);
                $(this).siblings('li').removeClass('current');
                $(this).addClass('current');
                plan = $(this).text();
                plan = plan.substring(0, 1);
                plan = plan.toLocaleLowerCase();
                localStorage.setItem('plan', plan);
                location.reload();
            });

            //試算表-選擇位數
            $(".spreadsheet-btn ul li").click(function(){
                $(this).toggleClass("current").siblings().removeClass('current');
                $("#s_digit").text($(this).text());
                reset();
            });

            //試算表-選擇數字
            $(".spreadsheet-ball ul li").click(function(){
                if ($(this).hasClass('current')){
                    $(this).removeClass('current');
                }else{
                    $(this).addClass('current');
                }

                if($(".spreadsheet-ball ul li.current").length <= 7){
                    $(".total").text($(".spreadsheet-ball ul li.current").size());
                    $("#tot_money").val($(".total").text()*$("#txbAmt").val());
                    if($(".total").text()>0){
                        $(".win").text(9.9*$("#txbAmt").val());
                    }else{
                        $(".win").text(0);
                    }
                    $(".e_mon").text($(".win").text() -  $("#tot_money").val());
                    addRow();
                }else{
                    alert("最多只能选择7个号码!");
                    $(this).removeClass('current');
                }
            });

            //每注金額
            $('#txbAmt').change(function(){
                if ($(this).val()>=2 && $(this).val()<=3000){
                    $("#tot_money").val($(".total").text()*$(this).val());
                    if($(".spreadsheet-ball ul li.current").length >= 1){
                        $(".win").text(9.9*$("#txbAmt").val());
                    }
                    $(".e_mon").text($(".win").text() -  $("#tot_money").val());
                }else{
                    alert("限额為2 - 3000!");
                }
            });

            //顯示載入中
            $(".loading").fadeIn(500);

            //載入預設位數、計劃
            loadChooseProject();

            //載入所有動態資料
            allreload();

            //設定每10秒載入所有動態資料
            setInterval("allreload()", 10000);
        });

        //試算表-重設
        function reset(){
            $(".total").text('0');
            $("#tot_money").val('0');
            $(".win").text('0');
            $(".e_mon").text('0');
            $("#all_num").text('');
            $(".spreadsheet-ball").find('.current').removeClass();
        }

        //試算表-加入選擇的數字
        function addRow(){
            var al_text = '';
            $(".spreadsheet-ball ul li.current").each(function(index){
                if(index != 0){
                    al_text = al_text + ',「<b>'+ $(this).contents()[0].textContent +'</b>」';
                }else{
                    al_text = al_text + '「<b>'+ $(this).contents()[0].textContent +'</b>」';
                }
            });
            $("#all_num").html(al_text);
        }

        //載入預設位數、計劃
        function loadChooseProject(){
            var categorytype = getCategoryType(), category = getCategory(), digit = getDigit(), plan = getPlan();

            $("#category-1 li").each(function(idx, li){
                if (category_ChineseToID($(li).text()) === category){
                    $(li).addClass('current');
                }else{
                    $(li).removeClass('current');
                }
            });
            $("#digit-2 li").each(function(idx, li){
                if (digit_ChineseToID($(li).text()) === digit){
                    $(li).addClass('current');
                }else{
                    $(li).removeClass('current');
                }
            });
            $("#item-1 li").each(function(idx, li){
                if (plan_ChineseToID($(li).text()) === plan){
                    $(li).addClass('current');
                }else{
                    $(li).removeClass('current');
                }
            });
            if (categorytype === 'category_lost'){
                $(".ssc-plan").hide();
            }
            if (categorytype === 'category_plan'){
                $(".ssc-plan").show();
            }
            //九州傳奇預測/號碼推薦的title-位數
            $("#forecastDigit").text(digit_IDToChinese(digit)+'位');
            //九州傳奇預測/號碼推薦的title-幾碼
            $("#forecastDigitNo").text(category_GetNo(category));
            //預測記錄的title-一星五、六、七碼
            if (categorytype === 'category_plan'){
                $("#recordtitle").text(category_IDToChinese(category)+digit_IDToChinese(digit)+'位'+plan_IDToChinese(plan));
            }
            //預測記錄的title-遺漏值
            if (categorytype === 'category_lost'){
                $("#analysistitle").text('遗漏值'+digit_IDToChinese(digit)+'位号码分析');
            }
        }

        //計類類別-取得一星幾碼
        function category_GetNo(category){
            switch (category){
                case 'yxwm':
                    category = '5';
                    break;
                case 'yxlm':
                    category = '6';
                    break;
                case 'yxqm':
                    category = '7';
                    break;
                default:
                    category = '5';
            }
            return category;
        }

        //計劃類別-中文轉ID
        function category_ChineseToID(category){
            switch (category){
                case '遗漏值计画':
                    category = 'yilou';
                    break;
                case '一星五码计画':
                    category = 'yxwm';
                    break;
                case '一星六码计画':
                    category = 'yxlm';
                    break;
                case '一星七码计画':
                    category = 'yxqm';
                    break;
                default:
                    category = 'yxwm';
            }
            return category;
        }

        //計劃類別-ID轉中文
        function category_IDToChinese(category){
            switch (category){
                case 'yilou':
                    category = '遗漏值计画';
                    break;
                case 'yxwm':
                    category = '一星五码计画';
                    break;
                case 'yxlm':
                    category = '一星六码计画';
                    break;
                case 'yxqm':
                    category = '一星七码计画';
                    break;
                default:
                    category = '一星五码计画';
            }
            return category;
        }

        //位數-中文轉ID
        function digit_ChineseToID(digit){
            switch(digit){
                case '万':
                    digit = 'w';
                    break;
                case '千':
                    digit = 'q';
                    break;
                case '百':
                    digit = 'b';
                    break;
                case '十':
                    digit = 's';
                    break;
                case '个':
                    digit = 'g';
                    break;
                default:
                    digit = 'w';
            }
            return digit;
        }

        //位數-ID轉中文
        function digit_IDToChinese(digit){
            switch(digit){
                case 'w':
                    digit = '万';
                    break;
                case 'q':
                    digit = '千';
                    break;
                case 'b':
                    digit = '百';
                    break;
                case 's':
                    digit = '十';
                    break;
                case 'g':
                    digit = '个';
                    break;
                default:
                    digit = '万';
            }
            return digit;
        }

        //計劃-中文轉ID
        function plan_ChineseToID(plan){
            switch(plan){
                case 'A计画':
                    plan = 'a';
                    break;
                case 'B计画':
                    plan = 'b';
                    break;
                case 'C计画':
                    plan = 'c';
                    break;
                case 'D计画':
                    plan = 'd';
                    break;
                case 'E计画':
                    plan = 'e';
                    break;
                default:
                    plan = 'a';
            }
            return plan;
        }

        //計劃-ID轉中文
        function plan_IDToChinese(plan){
            switch(plan){
                case 'a':
                    plan = 'A计画';
                    break;
                case 'b':
                    plan = 'B计画';
                    break;
                case 'c':
                    plan = 'C计画';
                    break;
                case 'd':
                    plan = 'D计画';
                    break;
                case 'e':
                    plan = 'E计画';
                    break;
                default:
                    plan = 'A计画';
            }
            return plan;
        }

        //取得存在localStorage的計劃類別(遺漏值category_lost，一星五、六、七碼計劃category_plan)
        function getCategoryType(){
            if (!localStorage.getItem('categorytype')){
                localStorage.setItem('categorytype', 'category_plan');
                return localStorage.getItem('categorytype');
            }else{
                return localStorage.getItem('categorytype');
            }
        }

        //取得存在localStorage的計劃類別ID
        function getCategory(){
            if (!localStorage.getItem('category')){
                localStorage.setItem('category', 'yxwm');
                return localStorage.getItem('category');
            }else{
                return localStorage.getItem('category');
            }
        }

        //取得存在localStorage的位數ID
        function getDigit(){
            if (!localStorage.getItem('digit')){
                localStorage.setItem('digit', 'w');
                return localStorage.getItem('digit');
            }else{
                return localStorage.getItem('digit');
            }
        }

        //取得存在localStorage的計劃ID
        function getPlan(){
            if (!localStorage.getItem('plan')){
                localStorage.setItem('plan', 'a');
                return localStorage.getItem('plan');
            }else{
                return localStorage.getItem('plan');
            }
        }

        //載入所有資料
        function allreload() {
            var category_type = getCategoryType();

            //一星五碼、六碼、七碼計劃
            if (category_type === 'category_plan'){
                latest_show();
                data_show();
                $(".category_plan").show();
                $(".category_lost").hide();
            }
            //遺漏值計劃
            if (category_type === 'category_lost'){
                latest_show2();
                data_show2();
                analysis_show();
                data_chart();
                $(".category_lost").show();
                $(".category_plan").hide();
            }
        }

        //show出最近資料-一星五、六、七碼計劃
        function latest_show() {
            var category = getCategory(), digit = getDigit(), plan = getPlan();
            var url, data;
            url =  './getLiveData.php?c=cqssc&a='+category+'_latest_show&planType='+category;
            if (category === 'yilou'){
                data = 'digit='+digit;
            }else{
                data = 'digit='+digit+'&plan='+plan;
            }
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error: function(){
                    $(".loading").fadeOut(500);
                },
                success: function(json, textStatus){
                    //取得當前期數
                    var currentNo = parseInt($("#currentNo").text());
                    //判斷當前期數是否有變動
                    if(currentNo != json.currentNo){
                        $(".loading").fadeIn(500);
                        $("#currentNo").html(json.currentNo);
                        $("#surplusNo").html(json.surplusNo);
                        $("#nextNo").html(json.nextNo);
                        $("#forecastNo").html(json.nextNo);
                        $("#number").find("li").eq(0).html(json.number[0]);
                        $("#number").find("li").eq(1).html(json.number[1]);
                        $("#number").find("li").eq(2).html(json.number[2]);
                        $("#number").find("li").eq(3).html(json.number[3]);
                        $("#number").find("li").eq(4).html(json.number[4]);
                        if(json.forecast != ''){
                            $("#forecast").find("li").eq(0).html(json.forecast[0]);
                            $("#forecast").find("li").eq(1).html(json.forecast[1]);
                            $("#forecast").find("li").eq(2).html(json.forecast[2]);
                            $("#forecast").find("li").eq(3).html(json.forecast[3]);
                            $("#forecast").find("li").eq(4).html(json.forecast[4]);
                            //一星五碼計劃
                            if (category === 'yxwm') {
                                $("#forecast").find("li").eq(5).css('style','display: none;');
                                $("#forecast").find("li").eq(6).css('style','display: none;');
                            }
                            //一星六碼計劃
                            if (category === 'yxlm' || category === 'yxqm'){
                                $("#forecast").find("li").eq(5).html(json.forecast[5]);
                                $("#forecast").find("li").eq(5).removeAttr('style');
                            }
                            //一星七碼計劃
                            if (category === 'yxqm'){
                                $("#forecast").find("li").eq(6).html(json.forecast[6]);
                                $("#forecast").find("li").eq(6).removeAttr('style');
                            }
                        }
                        $("#precision").html(json.precision);

                        if(json.raise == 1){
                            $('#raise').attr('class','icon-up');
                        }else if(json.raise == 2){
                            $('#raise').attr('class','icon-down');
                        }
                        var star = Math.floor(json.precision / 20);
                        var half = Math.round((json.precision % 20) / 2);
                        if(star != ''){
                            recommend = $(".forecast-box").find("ul.star");
                            recommend.empty();
                            for(var i=1 ; i<= star; i++){
                                recommend.append($('<li><i class="icon-star"></i></li>'));
                            }
                        }
                        if(half >= 5){
                            recommend.append($('<li><i class="icon-star-half-alt"></i></li>'));
                        }

                        var b = new Date;
                        var b = -b.getTimezoneOffset() / 60;
                        var i =  json.nextime;
                        var config = {
                            timeText: i, //倒计时时间
                            timeZone: b, //时区
                            style: "flip", //显示的样式，可选值有flip,slide,metal,crystal
                            color: "black", //显示的颜色，可选值white,black
                            width: 200, //倒计时宽度
                            textGroupSpace: 30, //天、时、分、秒之间间距
                            textSpace: 2, //数字之间间距
                            reflection: 0, //是否显示倒影
                            reflectionOpacity: 10, //倒影透明度
                            reflectionBlur: 0, //倒影模糊程度
                            dayTextNumber: 0, //倒计时天数数字个数
                            displayDay: 0, //是否显示天数
                            displayHour: 0, //是否显示小时数
                            displayMinute: !0, //是否显示分钟数
                            displaySecond: !0, //是否显示秒数
                            displayLabel: !0, //是否显示倒计时底部label
                            minText: '分',
                            onFinish: function() {
                                isOpening = true;
                                $('.opening').fadeIn();
                            }
                        };
                        if (isOpening){
                            $('.opening').fadeOut();
                            isOpening = false;
                        }
                        var a = json.nextime;
                        $(".time-countdown").jCountdown(config);
                        $(".loading").fadeOut(500);
                    }
                }
            });
        }

        //show出最近資料-遺漏值計劃
        function latest_show2() {
            var category = getCategory(), digit = getDigit(), plan = getPlan();
            var url, data;
            url =  './getLiveData.php?c=cqssc&a='+category+'_latest_show&planType='+category;
            if (category === 'yilou'){
                data = 'digit='+digit;
            }else{
                data = 'digit='+digit+'&plan='+plan;
            }
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error: function(){
                    $(".loading").fadeOut(500);
                },
                success: function(json, textStatus){
                    //取得當前期數
                    var currentNo = parseInt($("#currentNo2").text());
                    //判斷當前期數是否有變動
                    if(currentNo != json.currentNo){
                        $(".loading").fadeIn(500);
                        $("#currentNo2").html(json.currentNo);
                        $("#nextNo").html(json.nextNo);
                        $("#forecastNo").html(json.nextNo);
                        if(json.forecast != ''){
                            $("#forecast").find("li").eq(0).html(json.forecast[0]);
                            $("#forecast").find("li").eq(1).html(json.forecast[1]);
                            $("#forecast").find("li").eq(2).html(json.forecast[2]);
                            $("#forecast").find("li").eq(3).html(json.forecast[3]);
                            $("#forecast").find("li").eq(4).html(json.forecast[4]);
                        }
                        $("#precision").html(json.precision);

                        if(json.raise == 1){
                            $('#raise').attr('class','icon-up');
                        }else if(json.raise == 2){
                            $('#raise').attr('class','icon-down');
                        }
                        var star = Math.floor(json.precision / 20);
                        var half = Math.round((json.precision % 20) / 2);
                        recommend = $(".forecast-box").find("ul.star");
                        recommend.empty();
                        if(star != ''){
                            for(var i=1 ; i<= star; i++){
                                recommend.append($('<li><i class="icon-star"></i></li>'));
                            }
                        }
                        if(half >= 5){
                            recommend.append($('<li><i class="icon-star-half-alt"></i></li>'));
                        }
                        $(".loading").fadeOut(500);
                    }
                }
            });
        }

        //show出明細資料-一星五、六、七码
        function data_show() {
            var category = getCategory(), digit = getDigit(), plan = getPlan();
            var url, data;
            url =  './getLiveData.php?c=cqssc&a='+category+'_data_show&planType='+category;
            if (category === 'yilou'){
                data = 'digit='+digit;
            }else{
                data = 'digit='+digit+'&plan='+plan;
            }
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error:function(){
                    $(".loading").fadeOut(500);
                },
                success: function(json, textStatus){
                    $("table.data tbody:eq(0)").empty();
                    $("table.more-data tbody:eq(0)").empty();
                    if(json== null){
                        $("table.data tbody:eq(0)").append("<tr><td colspan='5' class='data-null'>暂无相关资料!</td></tr>");
                    }else{
                        if(json.latest != ''){
                            $.each(json.latest, function(i, item) {
                                drawData(item,"data");
                            });
                        }
                        if(json.record != ''){
                            $.each(json.record, function(i, item) {
                                drawData(item,"more-data");
                            });
                        }
                    }
                }
            });
        }

        //show出明細資料-遗漏值
        function data_show2() {
            var category = getCategory(), digit = getDigit(), plan = getPlan();
            var url, data;
            url =  './getLiveData.php?c=cqssc&a='+category+'_data_show&planType='+category;
            if (category === 'yilou'){
                data = 'digit='+digit;
            }else{
                data = 'digit='+digit+'&plan='+plan;
            }
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error: function(){
                    $(".loading").fadeOut(500);
                },
                success: function(json, textStatus){
                    $("table.data tbody:eq(0)").empty();
                    $("table.more-data tbody:eq(0)").empty();
                    if(json== null){
                        $("table.data tbody:eq(0)").append("<tr><td colspan='5' class='data-null'>暂无相关资料!</td></tr>");
                    }else{
                        if(json.latest != ''){
                            $.each(json.latest, function(i, item) {
                                drawData(item,"data");
                            });
                        }
                        if(json.record != ''){
                            $.each(json.record, function(i, item) {
                                drawData(item,"more-data");
                            });
                        }
                    }
                }
            });
        }

        //建立資料
        function drawData(item,type) {
            var row = $("<tr></tr>");
            $("table."+type+" tbody:eq(0)").append(row);
            row.append($("<td>" + item.no + "</td>"));
            if(item.forecast == '' && item.winNo == ''){
                row.append($("<td colspan='4' class='needreg'>欲观看当期最新预测号码，请加入星光会员后找客服开通<a href='/index.php?c=member&a=reg'><i class='icon-user-plus'></i>加入会员</a></td>"));
            }else if(item.forecast == '1' && item.winNo == '1'){
                row.append($("<td colspan='4' class='needreg'>欲观看当期最新预测号码，请联系客服立即开通<a href='javascript:openOnlineChat();'><i class='icon-headphones'></i>联络客服</a><a href=\"javascript:alert('尚未開放');\"><i class='icon-basket'></i>点数购买</a></td>"));
            }else{
                row.append($("<td>" + item.forecast + "</td>"));
                row.append($("<td>" + item.winNo + "</td>"));
                row.append($("<td>" + item.period + "</td>"));
                if(item.resultCode == 1) {
                    row.append($("<td class='tipsy_s' title='中'>" + item.result + "</td>"));
                }else if(item.resultCode == 2){
                    row.append($("<td class='tipsy_s' title='挂'>" + item.result + "</td>"));
                }else{
                    row.append($("<td> --- </td>"));
                }
            }
        }

        //遺漏值-show出分析
        function analysis_show() {
            var digit = getDigit();
            $.ajax({
                url: './getLiveData.php?c=cqssc&a=yilou_analysis_show&planType=yilou',
                type: 'post',
                data: 'digit='+digit,
                dataType: 'json',
                timeout: 10000,
                cache: false,
                error: function(){
                    $(".loading").fadeOut(500);
                },
                success: function(json, textStatus){
                    $("table.analysis tbody:eq(0)").empty();
                    if(json.data== null){
                        $("table.analysis tbody:eq(0)").append("<tr><td colspan='8' class='data-null'>暂无相关资料!</td></tr>");
                    }else{
                        $.each(json.data, function(i, item) {
                            var row = $("<tr></tr>");
                            var classname = "";
                            $("table.analysis tbody:eq(0)").append(row);
                            row.append($("<td>" + item.number + "</td>"));
                            row.append($("<td>" + item.times + "</td>"));
                            row.append($("<td>" + item.ratio + " %</td>"));
                            row.append($("<td>" + item.yilou_now + "</td>"));
                            row.append($("<td>" + item.yilou_20 + "</td>"));
                            row.append($("<td>" + item.yilou_60 + "</td>"));
                            row.append($("<td>" + item.yilou_120 + "</td>"));
                            row.append($("<td>" + item.probability + " %</td>"));
                        });
                        $("#sort-table").tablesorter();
                    }
                }
            });
        }

        //遺漏值-圖表資料
        function data_chart() {
            var digit = getDigit();
            $.ajax({
                url: './getLiveData.php?c=cqssc&a=yilou_chart&planType=yilou',
                data: "digit="+digit,
                type: 'post',
                dataType: "json",
                timeout: 10000,
                cache: false,
                error: function(){
                    $(".loading").fadeOut(500);
                },
                success: function (data) {
                    visitorData(data);
                }
            });
        }

        //遺漏值-号码遗漏值走势图
        function visitorData(data) {
            $('#chart').highcharts({
                title: {
                    text: '号码遗漏值走势图',
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
                series: data
            });
        }

        //遺漏值-設定圖表參數
        Highcharts.setOptions({
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
            }
        });

    </script>
</head>

<body>

<div class="loading" style="display: none;">
    <div class="loader">资料载入中，请稍后!</div>
</div>

<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid" style="padding-right: 0px; padding-left: 0px;">
        <div class="container" style="padding-right: 0px; padding-left: 0px;">
            <a href="/">
                <img src="/template/starball/Skin/images/img-sc/logo.png" alt="<?=SITE_CNAME?>">
            </a>
            <a href="<?='http://'.JU_DOMAIN.'/Aspx/Agentset.aspx?sAgentCode='.AGENT_CODE.'&add=1'?>" target="_blank">
                <img src="/template/starball/Skin/images/btn_reg.png" alt="点击注册">
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid banner-background">
    <h2 class="zoomInDown animated">
        <img src="/template/starball/Skin/images/img-sc/title-banner-1.png" alt="重庆时时彩">
    </h2>
    <p class="fadeIn animated banner-text">
        经中国国家财政部批准。具有玩法简单、中奖率高、开奖快、即买即兑、赔率设奖，固定奖金等特点。
    </p>
</div>

<div class="container">
    <!--彩票選項-->
    <div class="row">
        <div class="choose-project">
            <ul>
                <li style="display: none;">彩票大厅：
                    <ul>
                        <li class="current"><a href="javascript:void(0);">时时彩</a></li>
                        <li><a href="javascript:alert('尚未開放');">11选5</a></li>
                        <li><a href="javascript:alert('尚未開放');">北京赛车</a></li>
                        <li><a href="javascript:alert('尚未開放');">六合彩</a></li>
                    </ul>
                </li>
                <li style="display: none;">彩票类别：
                    <ul>
                        <li class="current"><a href="javascript:void(0);">重庆时时彩</a></li>
                        <li><a href="javascript:alert('尚未開放');">上海时时彩</a></li>
                        <li><a href="javascript:alert('尚未開放');">新疆时时彩</a></li>
                        <li><a href="javascript:alert('尚未開放');">天津时时彩</a></li>
                    </ul>
                </li>
                <li class="ssc-category">计画类别：
                    <ul id="category-1">
                        <li id="yilou"><a href="javascript:void(0);">遗漏值计画</a></li>
                        <li id="yxwm"><a href="javascript:void(0);">一星五码计画</a></li>
                        <li id="yxlm"><a href="javascript:void(0);">一星六码计画</a></li>
                        <li id="yxqm"><a href="javascript:void(0);">一星七码计画</a></li>
                    </ul>
                </li>
                <li class="ssc-digit" style="display: list-item;">位数选择：
                    <ul id="digit-1" style="display: none;">
                        <li><a href="/getPage.php?pagename=index.php?c=cqssc&a=yilou">万</a></li>
                        <li><a href="/getPage.php?pagename=index.php?c=cqssc&a=yilou&digit=q">千</a></li>
                        <li><a href="/getPage.php?pagename=index.php?c=cqssc&a=yilou&digit=b">百</a></li>
                        <li><a href="/getPage.php?pagename=index.php?c=cqssc&a=yilou&digit=s">十</a></li>
                        <li><a href="/getPage.php?pagename=index.php?c=cqssc&a=yilou&digit=g">个</a></li>
                    </ul>
                    <ul id="digit-2">
                        <li><a href="javascript:void(0);">万</a></li>
                        <li><a href="javascript:void(0);">千</a></li>
                        <li><a href="javascript:void(0);">百</a></li>
                        <li><a href="javascript:void(0);">十</a></li>
                        <li><a href="javascript:void(0);">个</a></li>
                    </ul>
                </li>
                <li class="ssc-plan" style="display: list-item;">计画选择：
                    <ul id="item-1">
                        <li><a href="javascript:void(0);">A计画</a></li>
                        <li><a href="javascript:void(0);">B计画</a></li>
                        <li><a href="javascript:void(0);">C计画</a></li>
                        <li><a href="javascript:void(0);">D计画</a></li>
                        <li><a href="javascript:void(0);">E计画</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--彩票說明-->
    <div class="row category_plan">
        <span class="title-2">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-description.png" alt="彩票说明">
        </span>
        <div class="description">
            <div class="col-md-3 col-sm-6 col-xs-12" style="border-right: 1px solid #e7e7e7;">
                <img class="img-responsive center-block" src="/template/starball/Skin/images/img-sc/description-logo-1.svg" style="height: 100%;" alt="重庆时时彩">
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 description_left left" style="padding-left: 0px; padding-right: 0px;">
                <div class="wd">
                    <span class="black-title">每天120期，今日剩余<b id="surplusNo">60</b>期</span>
                    <ul>
                        <li><i class="icon-ok"></i>白天72期，夜场48期</li>
                        <li><i class="icon-ok"></i>第一期截止为00:04:30</li>
                        <li><i class="icon-ok"></i>最后一期截止为23:59:30</li>
                        <li><i class="icon-sun"></i>白天10:00-22:00 10分钟一期</li>
                        <li><i class="icon-moon"></i>夜场22:00-02:00  5分钟一期</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 description_right left" style="background-color: #FFF; padding-left: 0px; padding-right: 0px;">
                <div class="new-no">
                    <span class="black-title">最新开奖 : 第<b class="white" id="currentNo">0</b>期</span>
                    <ul id="number">
                        <li>4</li>
                        <li>5</li>
                        <li>9</li>
                        <li>4</li>
                        <li>3</li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="next-no">
                    <span class="black-title">下期开奖 : 第<b class="white" id="nextNo">00</b>期</span>
                    <div class="next-time text-center">
                        <span class="wd" style="margin-right: 0px">距离下期开奖剩余 : <!--<b class="minute">分</b><b class="second">秒</b>--></span>
                        <span class="time-countdown">
                            <div class="jCountdownContainer" style="width: 200px; height: 54.6875px;">
                                <div class="jCountdownScale" style="transform: scale(0.78125); left: -28px; top: -7.65625px;">
                                    <div class="jCountdown flip black">
                                        <div class="group minute" style="margin-right: 10px;">
                                            <div class="container item1" style="margin-right: 2px;">
                                                <div class="text" style="background-position: -450px -896px;"></div>
                                            </div>
                                            <div class="container item2 lastItem" style="margin-right: 0px;">
                                                <div class="text" style="background-position: -250px -896px;"></div>
                                            </div>
                                        </div>
                                        <div class="group second lastItem" style="margin-right: 0px;">
                                            <div class="container item1" style="margin-right: 2px;">
                                                <div class="text" style="background-position: -250px -896px;"></div>
                                            </div>
                                            <div class="container item2 lastItem" style="margin-right: 0px;">
                                                <div class="text" style="background-position: -400px -896px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div id="opening" class="opening next-time text-center" style="display: none;">
                        <img src="/template/starball/Skin/images/jcountdown/number.gif">
                        <img src="/template/starball/Skin/images/jcountdown/number.gif">
                        <b>分</b>
                        <img src="/template/starball/Skin/images/jcountdown/number.gif">
                        <img src="/template/starball/Skin/images/jcountdown/number.gif">
                        <b>秒</b>
                        <span class="shadow" style="top: -80px"><b>开奖中，请稍候!</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--九州傳奇預測/號碼推荐-->
    <div class="row">
        <span class="title-2 category_lost">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-no-recommended.png" alt="九州传奇推荐">
        </span>
        <span class="title-2 category_plan">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-forecast.png" alt="九州传奇预测">
        </span>
        <div class="forecast">
            <div class="col-md-8 col-sm-8 forecast-left left" style="padding-top: 0px; padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                <div class="new-no">
                    <span id="latesttitle" class="black-title" style="height: 60px; vertical-align: middle;">最新预测推荐号码，第<b id="forecastNo">0</b>期<b id="forecastDigit">万位</b>共<b id="forecastDigitNo">5</b>码</span>
                    <ul id="forecast">
                        <li>0</li>
                        <li>0</li>
                        <li>0</li>
                        <li>0</li>
                        <li>0</li>
                        <li style="display: none;">0</li>
                        <li style="display: none;">0</li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 forecast-right left" style="padding-top: 0px; padding-left: 0px; padding-right: 0px; padding-bottom: 0px;">
                <span class="black-title" style="font-size: 16px; vertical-align: middle; height: 60px;"><b>预测精准度</b></span>
                <div class="forecast-box text-center">
                    <ul>
                        <li>命中率:
                            <h3>
                                <b id="precision">90</b><span style="font-size: large">%</span>
                                <span class="animated infinite flash">
                                    <i id="raise" class="icon-up"></i>
                                </span>
                            </h3>
                        </li>
                        <li>推荐值:
                            <ul class="star">
                                <li><i class="icon-star"></i></li>
                                <li><i class="icon-star"></i></li>
                                <li><i class="icon-star"></i></li>
                                <li><i class="icon-star"></i></li>
                                <li><i class="icon-star-half-alt"></i></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--遺漏值-號碼圖表-->
    <div class="row category_lost">
        <span class="title-2">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-number-chart.png" alt="号码图表">
        </span>
        <div class="no-chart">
            <div class="chart-body">
                <div id="chart"></div>
            </div>
        </div>
    </div>
    <!--遺漏值-號碼分析-->
    <div class="row category_lost">
        <span class="title-2">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-number-analysis.png" alt="星光分析">
        </span>
        <div class="no-analysis">
            <div class="record-head">
                <div class="record-top left">
                    <span class="black-title" id="analysistitle">遗漏值十位号码分析</span>
                </div>
                <div class="analysis-top right text-right">
                    据数更新至 第<b id="currentNo2">20160914035</b>期
                </div>
            </div>
            <div class="analysis-body">
                <table width="100%" border="0" class="analysis" id="sort-table">
                    <thead>
                    <tr>
                        <th width="10%" class="header">号码</th>
                        <th width="20%" class="header">开出/统计</th>
                        <th width="15%" class="header">出现比例</th>
                        <th width="10%" class="header">当前遗漏</th>
                        <th width="10%" class="header">20期遗漏</th>
                        <th width="10%" class="header">60期遗漏</th>
                        <th width="10%" class="header">120期遗漏</th>
                        <th width="15%" class="header">欲出机率</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span class="num">0</span></td>
                        <td>552 / 5315</td>
                        <td>10.386 %</td>
                        <td>14</td>
                        <td>14</td>
                        <td>14</td>
                        <td>30</td>
                        <td>155.56 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">1</span></td>
                        <td>498 / 5315</td>
                        <td>9.370 %</td>
                        <td>4</td>
                        <td><b class="green">4</b></td>
                        <td><b class="red">33</b></td>
                        <td>33</td><td>44.44 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">2</span></td>
                        <td>536 / 5315</td>
                        <td>10.085 %</td>
                        <td>7</td>
                        <td>12</td>
                        <td>21</td>
                        <td>21</td>
                        <td>77.78 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">3</span></td>
                        <td>488 / 5315</td>
                        <td><b class="green">9.182</b> %</td>
                        <td>1</td>
                        <td>15</td>
                        <td>18</td>
                        <td>18</td>
                        <td>11.11 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">4</span></td>
                        <td>547 / 5315</td>
                        <td>10.292 %</td>
                        <td><b class="red">25</b></td>
                        <td><b class="red">20</b></td>
                        <td>29</td>
                        <td><b class="red">64</b></td>
                        <td><b class="red">277.78</b> %</td>
                    </tr>
                    <tr>
                        <td><span class="num">5</span></td>
                        <td>529 / 5315</td>
                        <td>9.953 %</td>
                        <td>20</td>
                        <td><b class="red">20</b></td>
                        <td>20</td>
                        <td>22</td>
                        <td>222.22 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">6</span></td>
                        <td>576 / 5315</td>
                        <td><b class="red">10.837</b> %</td>
                        <td><b class="green">0</b></td>
                        <td>13</td><td>19</td>
                        <td>20</td>
                        <td><b class="green">0.00</b> %</td>
                    </tr>
                    <tr>
                        <td><span class="num">7</span></td>
                        <td>527 / 5315</td>
                        <td>9.915 %</td>
                        <td>2</td>
                        <td>7</td>
                        <td>17</td>
                        <td><b class="green">17</b></td>
                        <td>22.22 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">8</span></td>
                        <td>518 / 5315</td>
                        <td>9.746 %</td>
                        <td>5</td>
                        <td>14</td>
                        <td>32</td>
                        <td>34</td>
                        <td>55.56 %</td>
                    </tr>
                    <tr>
                        <td><span class="num">9</span></td>
                        <td>544 / 5315</td>
                        <td>10.235 %</td>
                        <td>3</td>
                        <td>11</td>
                        <td><b class="green">13</b></td>
                        <td>20</td>
                        <td>33.33 %</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--預測記錄/開獎記錄-->
    <div class="row ">
        <span class="title-2 category_lost">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-lotteryhistory.png" alt="开奖记录">
        </span>
        <span class="title-2 category_plan">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-record.png" alt="预测纪录">
        </span>
        <div class="record">
            <div class="record-head">
                <div class="record-top left">
                    <span id="recordtitle" class="black-title">一星五码万位A计画</span>
                </div>
                <div class="record-top right text-right">
                    <!--每<b id="time">60</b>秒后刷新-->
                    <span class="reload" style="display: none;">资料重新载入中...</span>
                </div>
                <!--
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        $(".fancy").fancybox({
                            'width'             : '40%',
                            'height'            : '100%',
                            'autoScale'         : false,
                            'transitionIn'      : 'none',
                            'transitionOut'     : 'none',
                            'type'              : 'iframe'
                        });
                    });
                </script>
                -->
            </div>
            <div class="record-body">
                <table width="100%" border="0" class="data">
                    <thead>
                    <tr>
                        <th width="18%">预测期号</th>
                        <th width="29%">推荐号码</th>
                        <th width="38%">中奖期 / 开奖号码</th>
                        <th width="7%">期数</th>
                        <th width="8%">准确度</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>074-076期</td>
                        <td>
                            <ul>
                                <li>0</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>7</li>
                            </ul>
                        </td>
                        <td>
                            <span class="period">正在进行第 2 期</span><br>
                        </td>
                        <td>---</td>
                        <td> --- </td>
                    </tr>
                    <tr>
                        <td>073-075期</td>
                        <td>
                            <ul>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>7</li>
                                <li class="bingo">8</li>
                            </ul>
                        </td>
                        <td>
                            <span class="period">073 期</span><br>
                            <ul>
                                <li class="now">8</li>
                                <li>8</li>
                                <li>3</li>
                                <li>5</li>
                                <li>1</li>
                            </ul>
                        </td>
                        <td>+1</td>
                        <td class="tipsy_s" title="中">
                                <span class="icon sunny">
			                        <span class="sun">
			                            <span class="rays"></span><br>
			                        </span>
			                    </span>
                        </td>
                    </tr>
                    <tr>
                        <td>071-073期</td>
                        <td>
                            <ul>
                                <li class="bingo">0</li>
                                <li>1</li>
                                <li>2</li>
                                <li>4</li>
                                <li>5</li>
                            </ul>
                        </td>
                        <td>
                            <span class="period">072 期</span><br>
                            <ul>
                                <li class="now">0</li>
                                <li>5</li>
                                <li>3</li>
                                <li>4</li>
                                <li>7</li>
                            </ul>
                        </td>
                        <td>+2</td>
                        <td class="tipsy_s" title="中">
                                <span class="icon sunny">
			                        <span class="sun">
			                            <span class="rays"></span><br>
			                        </span>
			                    </span>
                        </td>
                    </tr>
                    <tr>
                        <td>070-072期</td>
                        <td>
                            <ul>
                                <li>0</li>
                                <li>1</li>
                                <li>3</li>
                                <li class="bingo">4</li>
                                <li>5</li>
                            </ul>
                        </td>
                        <td>
                            <span class="period">070 期</span><br>
                            <ul>
                                <li class="now">4</li>
                                <li>3</li>
                                <li>0</li>
                                <li>0</li>
                                <li>6</li>
                            </ul>
                        </td>
                        <td>+1</td>
                        <td class="tipsy_s" title="中">
                                <span class="icon sunny">
			                        <span class="sun">
			                            <span class="rays"></span>
                                    </span>
                                </span>
                        </td>
                    </tr>
                    <tr>
                        <td>067-069期</td>
                        <td>
                            <ul>
                                <li>0</li>
                                <li>2</li>
                                <li>6</li>
                                <li>7</li>
                                <li>8</li>
                            </ul>
                        </td>
                        <td>
                            <span class="period"><b>---</b> 期</span><br>
                            <ul>
                                <li class="now">3</li>
                                <li>0</li>
                                <li>5</li>
                                <li>5</li>
                                <li>5</li>
                            </ul>
                        </td>
                        <td>---</td>
                        <td class="tipsy_s" title="挂">
                                <span class="icon rainy">
			                        <span class="cloud">
			                            <span class="rain"></span>
			                        </span>
			                    </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="panel-morerecords">
                    <table width="100%" border="0" class="data more-data">
                        <thead>
                        <tr>
                            <th width="18%"></th>
                            <th width="29%"></th>
                            <th width="38%"></th>
                            <th width="7%"></th>
                            <th width="8%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>065-067期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li class="bingo">2</li>
                                    <li>5</li>
                                    <li>6</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">066 期</span>
                                <ul>
                                    <li class="now">2</li>
                                    <li>8</li>
                                    <li>1</li>
                                    <li>8</li>
                                    <li>3</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                        <span class="sun">
			                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>064-066期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>4</li>
                                    <li class="bingo">5</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">064 期</span>
                                <ul>
                                    <li class="now">5</li>
                                    <li>6</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>0</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
                                        </span>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>063-065期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>5</li>
                                    <li class="bingo">6</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">063 期</span>
                                <ul>
                                    <li class="now">6</li>
                                    <li>3</li>
                                    <li>5</li>
                                    <li>1</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>061-063期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li class="bingo">3</li>
                                    <li>5</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">062 期</span>
                                <ul>
                                    <li class="now">3</li>
                                    <li>5</li>
                                    <li>3</li>
                                    <li>5</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>060-062期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li class="bingo">5</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">060 期</span>
                                <ul>
                                    <li class="now">5</li>
                                    <li>4</li>
                                    <li>8</li>
                                    <li>3</li>
                                    <li>1</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>057-059期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period"><b>---</b> 期</span>
                                <ul>
                                    <li class="now">1</li>
                                    <li>2</li>
                                    <li>9</li>
                                    <li>1</li>
                                    <li>3</li>
                                </ul>
                            </td>
                            <td>---</td>
                            <td class="tipsy_s" title="挂">
                                    <span class="icon rainy">
			                            <span class="cloud">
			                                <span class="rain"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>056-058期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>5</li>
                                    <li>7</li>
                                    <li class="bingo">9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">056 期</span>
                                <ul>
                                    <li class="now">9</li>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>2</li>
                                    <li>1</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>054-056期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li class="bingo">6</li>
                                    <li>7</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">055 期</span>
                                <ul>
                                    <li class="now">6</li>
                                    <li>3</li>
                                    <li>2</li>
                                    <li>7</li>
                                    <li>4</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>053-055期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li class="bingo">1</li>
                                    <li>2</li>
                                    <li>6</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">053 期</span>
                                <ul>
                                    <li class="now">1</li>
                                    <li>6</li>
                                    <li>7</li>
                                    <li>8</li>
                                    <li>3</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>052-054期</td>
                            <td>
                                <ul>
                                    <li class="bingo">0</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">052 期</span>
                                <ul>
                                    <li class="now">0</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>7</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>050-052期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>6</li>
                                    <li class="bingo">7</li>
                                    <li>8</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">051 期</span>
                                <ul>
                                    <li class="now">7</li>
                                    <li>8</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>0</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
			                            <span class="sun">
			                                <span class="rays"></span>
			                            </span>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>047-049期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>6</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period"><b>---</b> 期</span>
                                <ul>
                                    <li class="now">3</li>
                                    <li>1</li>
                                    <li>8</li>
                                    <li>3</li>
                                    <li>4</li>
                                </ul>
                            </td>
                            <td>---</td>
                            <td class="tipsy_s" title="挂">
                                    <span class="icon rainy">
			                            <span class="cloud">
			                                <span class="rain"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>045-047期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li class="bingo">2</li>
                                    <li>3</li>
                                    <li>6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">046 期</span>
                                <ul>
                                    <li class="now">2</li>
                                    <li>2</li>
                                    <li>6</li>
                                    <li>3</li>
                                    <li>6</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>042-044期</td>
                            <td>
                                <ul>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>8</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period"><b>---</b> 期</span>
                                <ul>
                                    <li class="now">1</li>
                                    <li>5</li>
                                    <li>5</li>
                                    <li>8</li>
                                    <li>0</li>
                                </ul>
                            </td>
                            <td>---</td>
                            <td class="tipsy_s" title="挂">
                                    <span class="icon rainy">
			                            <span class="cloud">
			                                <span class="rain"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>040-042期</td>
                            <td>
                                <ul>
                                    <li>2</li>
                                    <li class="bingo">4</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">041 期</span>
                                <ul>
                                    <li class="now">4</li>
                                    <li>2</li>
                                    <li>9</li>
                                    <li>0</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>038-040期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li class="bingo">4</li>
                                    <li>5</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">039 期</span>
                                <ul>
                                    <li class="now">4</li>
                                    <li>3</li>
                                    <li>9</li>
                                    <li>6</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>035-037期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li class="bingo">9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">037 期</span>
                                <ul>
                                    <li class="now">9</li>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>8</li>
                                    <li>4</li>
                                </ul>
                            </td>
                            <td>+3</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>033-035期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>3</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li class="bingo">7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">034 期</span>
                                <ul>
                                    <li class="now">7</li>
                                    <li>3</li>
                                    <li>8</li>
                                    <li>2</li>
                                    <li>5</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>031-033期</td>
                            <td>
                                <ul>
                                    <li class="bingo">3</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>7</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">032 期</span>
                                <ul>
                                    <li class="now">3</li>
                                    <li>2</li>
                                    <li>5</li>
                                    <li>8</li>
                                    <li>6</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>030-032期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>1</li>
                                    <li class="bingo">2</li>
                                    <li>6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">030 期</span>
                                <ul>
                                    <li class="now">2</li>
                                    <li>0</li>
                                    <li>6</li>
                                    <li>5</li>
                                    <li>0</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>027-029期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period"><b>---</b> 期</span>
                                <ul>
                                    <li class="now">3</li>
                                    <li>6</li>
                                    <li>8</li>
                                    <li>5</li>
                                    <li>2</li>
                                </ul>
                            </td>
                            <td>---</td>
                            <td class="tipsy_s" title="挂">
                                    <span class="icon rainy">
                                        <span class="cloud">
                                            <span class="rain"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>026-028期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li class="bingo">1</li>
                                    <li>3</li>
                                    <li>6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">026 期</span>
                                <ul>
                                    <li class="now">1</li>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>2</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                            			</span>
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>025-027期</td>
                            <td>
                                <ul>
                                    <li>2</li>
                                    <li>4</li>
                                    <li>6</li>
                                    <li class="bingo">8</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">025 期</span>
                                <ul>
                                    <li class="now">8</li>
                                    <li>9</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>023-025期</td>
                            <td>
                                <ul>
                                    <li class="bingo">0</li>
                                    <li>1</li>
                                    <li>2</li>
                                    <li>4</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">024 期</span>
                                <ul>
                                    <li class="now">0</li>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>4</li>
                                    <li>5</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>022-024期</td>
                            <td>
                                <ul>
                                    <li>2</li>
                                    <li>5</li>
                                    <li>6</li>
                                    <li>7</li>
                                    <li class="bingo">9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">022 期</span>
                                <ul>
                                    <li class="now">9</li>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>8</li>
                                    <li>4</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                            			</span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>020-022期</td>
                            <td>
                                <ul>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>6</li>
                                    <li class="bingo">7</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">021 期</span>
                                <ul>
                                    <li class="now">7</li>
                                    <li>6</li>
                                    <li>6</li>
                                    <li>8</li>
                                    <li>0</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
			                            </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>018-020期</td>
                            <td>
                                <ul>
                                    <li class="bingo">3</li>
                                    <li>4</li>
                                    <li>5</li>
                                    <li>7</li>
                                    <li>9</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">019 期</span>
                                <ul>
                                    <li class="now">3</li>
                                    <li>1</li>
                                    <li>4</li>
                                    <li>6</li>
                                    <li>1</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>016-018期</td>
                            <td>
                                <ul>
                                    <li>1</li>
                                    <li>2</li>
                                    <li class="bingo">5</li>
                                    <li>6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">017 期</span>
                                <ul>
                                    <li class="now">5</li>
                                    <li>8</li>
                                    <li>7</li>
                                    <li>9</li>
                                    <li>2</li>
                                </ul>
                            </td>
                            <td>+2</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>015-017期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li class="bingo">1</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li>7</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">015 期</span>
                                <ul>
                                    <li class="now">1</li>
                                    <li>4</li>
                                    <li>8</li>
                                    <li>7</li>
                                    <li>1</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                                        </span>
			                        </span>
                            </td>
                        </tr>
                        <tr>
                            <td>014-016期</td>
                            <td>
                                <ul>
                                    <li>0</li>
                                    <li>2</li>
                                    <li>3</li>
                                    <li class="bingo">6</li>
                                    <li>8</li>
                                </ul>
                            </td>
                            <td>
                                <span class="period">014 期</span>
                                <ul>
                                    <li class="now">6</li>
                                    <li>8</li>
                                    <li>8</li>
                                    <li>4</li>
                                    <li>3</li>
                                </ul>
                            </td>
                            <td>+1</td>
                            <td class="tipsy_s" title="中">
                                    <span class="icon sunny">
                                        <span class="sun">
                                            <span class="rays"></span>
                                        </span>
                                    </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="record-bootom">
                <a href="javascript: void(0);" class="bt-morerecords">
                    <span>更多预测纪录</span><strong>收合预测纪录</strong>
                </a>
            </div>
        </div>
    </div>
    <!--一星五、六、七碼計畫-試算表-->
    <div class="row category_plan">
        <span class="title-2">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-spreadsheet.png" alt="试算表">
        </span>
        <div class="spreadsheet">
            <div class="col-lg-8 col-md-8 col-sm-8 colxs-12 spreadsheet-left left" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">
                <span class="black-title">一星五码试算表</span>
                <div class="spreadsheet-btn">
                    <ul>
                        <li class="current"><i class="icon-location"></i>万位</li>
                        <li><i class="icon-location"></i>千位</li>
                        <li><i class="icon-location"></i>百位</li>
                        <li><i class="icon-location"></i>十位</li>
                        <li><i class="icon-location"></i>个位</li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <div class="spreadsheet-ball">
                    <ul>
                        <li>0<span>9.9</span></li>
                        <li>1<span>9.9</span></li>
                        <li>2<span>9.9</span></li>
                        <li>3<span>9.9</span></li>
                        <li>4<span>9.9</span></li>
                        <li>5<span>9.9</span></li>
                        <li>6<span>9.9</span></li>
                        <li>7<span>9.9</span></li>
                        <li>8<span>9.9</span></li>
                        <li>9<span>9.9</span></li>
                        <div class="clear"></div>
                    </ul>
                </div>
                <h3>※ 试算表水位由「九卅天下现金网提供」!</h3>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 spreadsheet-right left" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">
                <span class="black-title">试算表內容及結果</span>
                <ul class="wd">
                    <li>单注限额：2 - 3000</li>
                    <li>水位：<span>9.9</span></li>
                </ul>
                <div class="spreadsheet-right-control center-block">
                    <ul>
                        <li>共<span class="total">0</span>注</li>
                        <li class="all_num">选项：<span id="s_digit">万位</span> <span id="all_num"></span></li>
                        <li>每注金额：<input type="text" id="txbAmt" name="per-money" value="10"></li>
                        <li>交易总额：<input type="text" id="tot_money" name="total-money" value="0" readonly=""></li>
                        <li>可赢金额：<span class="win">0</span> 盈利：<span class="e_mon">0</span></li>
                    </ul>
                </div>
                <div class="spreadsheet-right-btn"><a href="javascript:reset();"><i class="icon-ccw"></i>重置</a></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--footer-->
    <footer>
        <div class="row" style="background-color: black;">
            <div class="col-md-6 col-sm-12 col-xs-12 footer-left">
                <span class="title-2">
                    <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-footer-recommend.png" alt="星光推荐">
                </span>
                <ul class="ad">
                    <!--<li>
                        <a href="http://cd658.88sport.net" target="blank">
                            <figure class="imghvr-zoom-out-flip-horiz">
                                <img class="img-responsive" src="upload/images/ad/footer-ad1.jpg" alt="九卅傳奇现金网 - 全球彩票">
                                <figcaption>
                                    <h3>九卅傳奇现金网 - 全球彩票</h3>
                                    <p>14种游戏100种玩法/赔率高，开奖快！百万彩金等着你!</p>
                                </figcaption>
                            </figure>
                        </a>
                    </li>-->
                    <li>
                        <a href="http://88sport.net" target="blank">
                            <figure class="imghvr-zoom-out-flip-horiz">
                                <img class="img-responsive" src="upload/images/ad/footer-ad2.jpg" alt="88比分网">
                                <figcaption>
                                    <h3>88比分网</h3>
                                    <p>足球预测赛事比分、预测分析、计数、资料、新闻、数据,打造专业的体育数据服务!</p>
                                </figcaption>
                            </figure>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 footer-right">
                <span class="title-2">
                    <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-footer-contact.png" alt="客服中心">
                </span>
                <ul>
                    <li><i class="icon-qq"></i>QQ客服：<?=QQ_CS?></li>
                    <li><i class="icon-wechat"></i>微信客服：<?=WECHATID?></li>
                    <li><i class="icon-mail-alt"></i>电邮：<a href="<?=EMAIL?>"><?=EMAIL?></a></li>
                    <li><i class="icon-weibo"></i>官方微博：<a href="http://www.weibo.com/u/5984978153?topnav=1&amp;wvr=6&amp;topsug=1&amp;is_hot=1"><?=SITE_CNAME?></a></li>
                    <li><i class="icon-back-in-time"></i>服务时间：<b>每日 10:00~24:00</b></li>
                </ul>
                <div class="footer-right-qr">
                    <img src="/template/starball/Skin/images/footer-qrcode.jpg">
                </div>
            </div>
            <div class="clear"></div>
            <div class="footer-bottom">Copyright © 2016<a href="/">九卅傳奇彩票</a>版权所有. JUBall All Rights Reserved.</div>
        </div>
    </footer>
</div>

</body>