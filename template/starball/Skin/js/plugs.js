// JavaScript Document


$(function() {
    /*跑馬燈*/
    $('#breakingnews').BreakingNews({
        timer: 4000,
        effect: 'slide'
    });
    /* 語系選單 */
    if ($('.lang').length) {
        $('.lang').on('click', function() {
            var $this = $(this).find("i");
            if ($this.hasClass('icon-down-dir')) {
                $this.attr('class', 'icon-up-dir');
                $(this).find("ul").addClass('on');
                $(this).find("ul").animate({ 'height': '110px' }, 300);
            } else {
                $this.attr('class', 'icon-down-dir');
                $(this).find("ul").animate({ 'height': '0' }, 100);
                $(this).find("ul").removeClass('on');

            }
        });
    }

    /* 會員帳號倒數時間顯示 */
    if ($('.m-time').length) {
        $(".m-time").hover(function() {
            $('.m-time ul').animate({
                width: '300px',
                height: '135px',
                left: '-85px',
                top: '100%',
                opacity: '1',
            }, "fast");
        }, function() {
            $('.m-time ul').animate({
                width: '0px',
                height: '0px',
                left: '0',
                top: '50%',
                opacity: '0',
            }, "fast");
        });
    }

    /* 會員中心下拉選單 */
    if ($('.m-info').length) {
        $(".m-info").hover(function() {
            $('.m-info ul').slideDown("fast");
              
        }, function() {
            $('.m-info ul').slideUp("fast");
        });
    }

    /* 主選單 */
    $(".nav_list").hover(function() {
        $(this).addClass("current").siblings().removeClass("current");
        var dropdownTab = $(this).data("dropdownTab");

        var currDropdownTab = $(".nav-submenu").data("currDropdownTab");

        if (dropdownTab !== undefined) {
            if (dropdownTab !== currDropdownTab){slideUpDropdownTab(dropdownTab)}
        } else {
            slideUpDropdonwTab()
        }
    }, function() {
        if ($(this).attr("data-dropdown-tab") === undefined){slideUpDropdonwTab()}
    });

    $(".nav-submenu").hover(function(){},function(){slideUpDropdonwTab()});

    function slideUpDropdownTab(a) {
        $(".nav-submenu").data("currDropdownTab", a);
        $("#" + a).stop().fadeIn().siblings().hide();
        $(".nav-submenu").slideDown("fast", function() {})
    }

    function slideUpDropdonwTab() {
        $(".nav_list").removeClass("current");
        $(".nav-submenu").slideUp("fast", function() {});
        $(".nav-submenu").removeData("currDropdownTab")
    }


    /* 活動區塊 */
    if($('#activity ul').length > 0){   
        $('#activity ul').responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            namespace: 'centered-btns',
        });
    }

    /* 底部官方LOGO */
    if($('.slider-logo').length > 0){   
        $('.slider-logo').bxSlider({
            slideWidth: 200,
            minSlides: 1,
            maxSlides: 5,
            moveSlides: 1,
            slideMargin: 5,
            pager:false,
            controls:false,
            autoControls: true,
            auto: true,
            autoControls: false,
        });
    }

    /* 更多預測資料按鈕 */
    if($('.bt-morerecords').length > 0){   
        $(".bt-morerecords").click(function(){
            $(this).parent().parent().find(".panel-morerecords").slideToggle("fast");
            $(this).toggleClass("panel-morerecords-active");
            return false;
        });
    }

    /* 計畫選項 */
    if($('.have-item').length > 0){
        $(".have-item").click(function(){
            //點擊伸縮第二層選項
            $(this).find("ul.list").slideToggle("fast");
            //關閉其他的第二層選項
            $(this).siblings().find("ul.list").slideUp("fast");
            $(this).toggleClass("active").siblings().removeClass('active');
            //檢查是否有第三層選項被點選 
            var curIndex = $('.have-item ul.list').find('.active').index()+1;
            //執行關閉展開下拉選項
            if (curIndex>0) {
               $('.have-item ul.list').find('.active').removeClass('active');
               $('#item-'+curIndex).stop(false, true).fadeOut();
               $(".sub-item").slideUp();
            }
        })  

        /* 計畫次選項 */
        $('.have-item ul.list li').click(function() {
            var $this = $(this);
            if ($this.parent().parent().find(".sub-item").index()>0){
                var curIndex = $(this).index()+1;
                if($this.hasClass('active')){
                    $this.removeClass('active');
                    $this.parent().parent().find('#item-'+curIndex).stop(false, true).fadeOut();
                    $this.parent().parent().find(".sub-item").slideUp();
                }else{
                    $this.addClass('active').siblings().removeClass('active');
                    $this.parent().parent().find('#item-'+curIndex).stop(false, true).fadeIn().siblings().hide();
                    $this.parent().parent().find(".sub-item").slideDown();
                }
                return false;
            }
        });
    }

    /* 內容頁計畫選項 */
   if($('.choose-project ul li').length > 0){
        //取得當前已選的類別名稱
        $category =$('ul > li.ssc-category > ul li.current').attr('id');
        //找尋選中的類別是第幾個
        $now_category = $('ul > li.ssc-category > ul li.current').index()+1;
        if($now_category > 0){
            $('ul > li.ssc-digit').show();
            $('ul > li.ssc-digit').find('#digit-'+$now_category).show().siblings().hide();
        }

        //類別切換
        $('li.ssc-category ul li.open').click(function(){
            var $this = $(this);
            var category = $this.attr('id');
            var curIndex = $(this).index()+1;
            //將點選的類別代碼回傳到變數中
            $category = category;
            
            $this.toggleClass('current').siblings().removeClass('current');
            $('li.ssc-digit ul li').removeClass('current');
            if(category == 'yilou' || category == 'yxwm'){
                //當已有點擊狀態
                if($this.hasClass('current')){
                    $this.parent().parent().parent().find('#digit-'+curIndex).stop(false, true).fadeIn().siblings().hide();
                    $this.parent().parent().parent().find(".ssc-digit").slideDown("fast");
                    $this.parent().parent().parent().find(".ssc-plan").slideUp("fast");
                    $now_digit = $('ul > li.ssc-digit > ul li.current').index()+1;
                    if($now_digit > 0 && category == 'yxwm'){
                        $('ul > li.ssc-plan').slideDown("fast");
                    }
                }else{
                    $this.parent().parent().parent().find('#digit-'+curIndex).stop(false, true).fadeOut();
                    $this.parent().parent().parent().find(".ssc-digit").slideUp("fast");
                    $this.parent().parent().parent().find(".ssc-plan").slideUp("fast");
                }
            }

        });
        $now_digit = $('ul > li.ssc-digit > ul li.current').index()+1;
        if($now_digit > 0){
            $('ul > li.ssc-plan').show();
            $('ul > li.ssc-plan').find('#item-'+$now_digit).show().siblings().hide();
        }
        $('li.ssc-digit ul li').click(function() {
            var $digit = $(this);
            var curIndex = $(this).index()+1;
            $digit.toggleClass('current').siblings().removeClass('current');
            if($category == 'yxwm'){
                if($digit.hasClass('current')){
                    $digit.parent().parent().parent().find('#item-'+curIndex).stop(false, true).fadeIn().siblings().hide();
                    $digit.parent().parent().parent().find(".ssc-plan").slideDown("fast");
                }else{
                    $digit.parent().parent().parent().find('#item-'+curIndex).stop(false, true).fadeOut();
                    $digit.parent().parent().parent().find(".ssc-plan").slideUp("fast");
                } 
            }
        });
         

   }

});

/* 認證表單 =================================================*/
$(document).ready(function(){
    if($("#validate").length > 0){
        $("#validate").validationEngine('attach',{promptPosition : "bottomRight",scroll: false ,});
    }
});

/* 彈出黑色透明說明*/
$(document).ready(function(){
        $(".tipsy_n").tipsy({fade: true,gravity: 'n',live: true});
        $(".tipsy_nw").tipsy({fade: true,gravity: 'nw',live: true});
        $(".tipsy_ne").tipsy({fade: true,gravity: 'ne',live: true});
        $(".tipsy_e").tipsy({fade: true,gravity: 'e',live: true});
        $(".tipsy_sw").tipsy({fade: true,gravity: 'sw',live: true});
        $(".tipsy_s").tipsy({fade: true,gravity: 's',live: true});
        $(".tipsy_se").tipsy({fade: true,gravity: 'se',live: true});

});

/*滾動回TOP*/
$(function() {
    $(".gotop").click(function() {
        jQuery("html,body").animate({
            scrollTop: 0
        }, 1000);
    });
});

/*浮動客服*/
$(function(){
    $('#main-im').css("height","272");
    $('#im_main').show();
    $('#open_im').hide();
    $('#close_im').bind('click',function(){
        $('#main-im').css("height","0");
        $('#im_main').hide(200);
        $('#open_im').show(200);
    });
    $('#open_im').bind('click',function(e){
        $('#main-im').css("height","272");
        $('#im_main').show(200);
        $(this).hide(200);
    });

    $(".weixing-container").bind('mouseenter',function(){
        $('.weixing-show').show(100);
    })
    $(".weixing-container").bind('mouseleave',function(){        
        $('.weixing-show').hide(100);
    });
});

/* 開啟線上客服 */
function openOnlineChat() {
    var a = "http://f88.live800.com/live800/chatClient/chatbox.jsp?companyID=691581&configID=137411&jid=4641529630";
    var c = (screen.width / 2) - (600 / 2);
    var b = (screen.height / 2) - (400 / 2);
    window.open(a, "DescriptiveWindowName", "resizable,scrollbars=yes,status=1,width=600, height=400, top=" + b + ", left=" + c)
}