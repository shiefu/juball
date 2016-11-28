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
    <link rel="icon" href="/template/starball/Skin/images/ico/favicon-32x32.png" sizes="32x32">
    <!--CSS-->
    <link rel="stylesheet" href="/template/starball/Skin/css/fontello.css" media="all">
    <link rel="stylesheet" href="/template/starball/Skin/css/animate.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/imagehover.min.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/jcountdown.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/tipsy.css">
    <link rel="stylesheet" href="/template/starball/Skin/css/style.css">
    <link rel="stylesheet" href="/template/starball/Skin/bootstrap-3.3.7/css/bootstrap.min.css">
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
        body {
            line-height: 1.8em;
            color: #333;
            background-color: #e8e3df;
            font: 0.75em Verdana,"Microsoft YaHei", Arial, Helvetica, sans-serif;
            padding-top: 66px;
        }
    </style>
    <!--JS--><!--JS-->
    <script src="/template/starball/Skin/js/jquery-1.12.4.min.js"></script>
    <script src="/template/starball/Skin/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="/template/starball/Skin/js/BreakingNews.js"></script>
    <script src="/template/starball/Skin/js/jquery.jcountdown.min.js"></script>
    <script src="/template/starball/Skin/js/jquery.bxslider.min.js"></script>
    <script src="/template/starball/Skin/js/jquery.tipsy.js"></script>
    <script src="/template/starball/Skin/js/plugs.js"></script>
    <script src="/template/starball/Skin/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var site_dir="/";
    </script>
</head>

<body>

<div class="container-fluid banner-background">
    <h2 class="zoomInDown animated">
        <img src="/template/starball/Skin/images/img-sc/title-banner-1.png" alt="重庆时时彩">
    </h2>
    <p class="fadeIn animated banner-text">
        经中国国家财政部批准。具有玩法简单、中奖率高、开奖快、即买即兑、赔率设奖，固定奖金等特点。
    </p>
</div>

<div class="container">
    <div class="row">
        <span class="title-2">
            <img class="img-responsive" src="/template/starball/Skin/images/img-sc/title-description.png" alt="彩票说明">
        </span>
        <div class="description">
            <div class="col-md-3 col-sm-6 equal-height" style="border-right: 1px solid #e7e7e7;">
                <img class="img-responsive center-block" src="/template/starball/Skin/images/img-sc/description-logo-1.svg" style="height: 100%;" alt="重庆时时彩">
            </div>
            <div class="col-md-3 col-sm-6 equal-height description_left left" style="padding-left: 0px; padding-right: 0px;">
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
            <div class="col-md-6 col-sm-12 equal-height description_right left" style="background-color: #FFF; padding-left: 0px; padding-right: 0px;">
                <div class="new-no text-center" style="text-align: center">
                    <span class="black-title">最新开奖 : 第<b class="white" id="currentNo">60</b>期</span>
                    <div class="center-block">
                    <ul id="number">
                        <li>4</li>
                        <li>5</li>
                        <li>9</li>
                        <li>4</li>
                        <li>3</li>
                        <div class="clear"></div>
                    </ul>
                    </div>
                </div>
                <div class="next-no">
                    <span class="black-title">下期开奖 : 第<b class="white" id="nextNo">61</b>期</span>
                    <div class="next-time">
                        <span class="wd">距离下期开奖剩余 : <b class="minute">分</b><b class="second">秒</b></span>
                        <span class="time-countdown"><div class="jCountdownContainer" style="width: 200px; height: 54.6875px;"><div class="jCountdownScale" style="transform: scale(0.78125); left: -28px; top: -7.65625px;"><div class="jCountdown flip black"><div class="group minute" style="margin-right: 50px;"><div class="container item1" style="margin-right: 2px;"><div class="text" style="background-position: -450px -896px;"></div></div><div class="container item2 lastItem" style="margin-right: 0px;"><div class="text" style="background-position: -250px -896px;"></div></div></div><div class="group second lastItem" style="margin-right: 0px;"><div class="container item1" style="margin-right: 2px;"><div class="text" style="background-position: -250px -896px;"></div></div><div class="container item2 lastItem" style="margin-right: 0px;"><div class="text" style="background-position: -400px -896px;"></div></div></div></div></div></div></span>
                    </div>
                    <div class="opening" style="display: none;">
                        <span class="now-minute"><img src="/template/starball/Skin/images/jcountdown/number.gif"><img src="/template/starball/Skin/images/jcountdown/number.gif"></span>
                        <span class="now-second"><img src="/template/starball/Skin/images/jcountdown/number.gif"><img src="/template/starball/Skin/images/jcountdown/number.gif"></span>
                        <span class="shadow"><b>开奖中，请稍候!</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>