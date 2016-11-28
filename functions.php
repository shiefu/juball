<?php

//define('SOURCE_DOMAIN', 'http://www.99shishicai.com');
define('AGENT_CODE', 'az5216');
define('JU_DOMAIN', 'ju11.net');
define('SOURCE_DOMAIN', 'http://k202.slcai1.com/');
define('SITE_CNAME', '九卅傳奇彩票');
define('SITE_ENAME', 'JUBall');
define('SITE_CASH_CNAME', '九卅傳奇现金网');
define('SITE_SPORT_CNAME', '88比分网');
define('JUBALL_URL', 'http://'.$_SERVER['SERVER_NAME']);
define('CD658_URL', 'http://cd658.88sport.net');
define('SPORT_URL', 'http://88sport.net');
define('QQ_CS', '2675818478');
define('QQ_GROUP', '577278049');
define('WECHATID', 'az521688');
define('EMAIL', QQ_CS.'@qq.com');
define('USERNAME', 'M61130');
define('PASSWORD', 'QAZ0609');

//================================================================================
//根據頁面名稱，取得頁面種類
//================================================================================
function getPageType($pagename){
    $pagename = strtolower($pagename);
    parse_str(parse_url($pagename, PHP_URL_QUERY), $parameters);
    if (array_key_exists('c', $parameters)){
        $pagetype = $parameters["c"];
    }else{
        $pagetype = "";
    }

    return $pagetype;
}

//================================================================================
//取代共通的頁面連結
//================================================================================
function replace_common($html){
    //將星光彩票取代成我們的站名
    $html = str_replace('星光彩票', SITE_CNAME, $html);

    //移除點擊咨詢
    $html = str_replace('<script language="javascript" src="http://f88.live800.com/live800/chatClient/monitor.js?jid=4641529630&companyID=691581&configID=137410&codeType=custom"></script>', '', $html);
    $html = str_replace('<script language="javascript" src="http://f88.live800.com/live800/chatClient/monitorStatic5.js"></script>', '', $html);
    $html = str_replace('<script type="text/javascript" id="lim:component" src="http://f88.live800.com/live800/chatClient/component-v5.js"></script>', '', $html);
    $html = str_replace('<link id="invite_style" type="text/css" rel="stylesheet" href="http://f88.live800.com/live800/chatClient/invite/theme/0/invite.css">', '', $html);
    $html = str_replace('<link id="mini_chat_style" type="text/css" rel="stylesheet" href="http://f88.live800.com/live800/chatClient/version5/style/theme/userColor/mini.css">', '', $html);
    $html = removeByID("lim_mini", $html);

    //移除官方分享
    $html = removeByClass('official-share', $html);

    //移除視訊客服
    $html = removeByClass('main-im', $html);

    //開通教學
    $html = str_replace('/index.php?c=article&id=1', '/getPage.php?pagename=index.php?c=article&id=1', $html);

    //移除最頂
    $html = removeByID("top", $html);

    //取代Menu
    $html = str_replace('/index.php?c=cqssc', '/getPage.php?pagename=index.php?c=cqssc', $html);

    //移除menu
    $html = removeByID("menu", $html);

    //將註冊按扭移除
    $html = removeByClass("btn", $html);
    $html = removeByClass("needreg", $html);
    $html = removeByClass("breadcrumb-wrap", $html);

    //取代Footer
    $html = str_replace('http://99sport.net', SPORT_URL, $html);
    $html = str_replace('http://ts977.net', CD658_URL, $html);
    $html = str_replace('99比分網', SITE_SPORT_CNAME, $html);
    $html = str_replace('99比分网', SITE_SPORT_CNAME, $html);
    $html = str_replace('StarBall', SITE_ENAME, $html);
    $html = str_replace('九卅天下現金網', SITE_CASH_CNAME, $html);
    $html = str_replace('九卅天下现金网', SITE_CASH_CNAME, $html);
    $html = str_replace('2062619183', QQ_CS, $html);
    $html = str_replace('nanaa887766', WECHATID, $html);
    $html = replace_email($html);
    $html = replace_recommended($html);

    return $html;
}

//================================================================================
//根據頁面種類，取代連結
//================================================================================
function replace_html($pagetype, $html){
    $pagetype = strtolower($pagetype);

    $html = replace_common($html);

    switch($pagetype){
        case 'cqssc':
            //最新開獎
            $html = str_replace('./?c=cqssc&a=latest_show', '/getLiveData.php?c=cqssc&a=latest_show', $html);
            //預測記錄
            $html = str_replace('./?c=cqssc&a=data_show', '/getLiveData.php?c=cqssc&a=data_show', $html);
            //取代試算表
            $html = str_replace('九卅天下现金网', SITE_CASH_CNAME, $html);
            $html = str_replace('www.ts977.net', CD658_URL, $html);
            //移除選擇計劃
            $html = removeChoosePlan($html);
            break;
        default:
    }

    return $html;
}

//================================================================================
//根據頁面種類，取代表格連結
//================================================================================
function replace_livedata($pagetype, $html){
    $pagetype = strtolower($pagetype);

    switch($pagetype){
        case 'cqssc':
            break;
    }

    return $html;
}

//================================================================================
//依據id移除節點
//================================================================================
function removeByID($id, $html){
    libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    if (is_string($id)){
        $node = $doc->getElementById($id);
        if (!is_null($node)){
            $node->parentNode->removeChild($node);
        }
    }
    $html = $doc->saveHTML();
    unset($node);
    unset($doc);
    $doc = null;
    $node = null;

    $html = str_replace('row.append($("<td>" + item.no + ""));', 'row.append($("<td>" + item.no + "</td>>"));', $html);
    return html_entity_decode($html);
}

//================================================================================
//依據class移除節點
//================================================================================
function removeByClass($class, $html){
    libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    $xpath = new DOMXPath($doc);

    if (is_string($class)){
        $nodes = $xpath->query("//*[contains(@class, '$class')]");
        foreach($nodes as $node){
            $node->parentNode->removeChild($node);
        }
    }

    $html = $doc->saveHTML();

    unset($doc);
    unset($xpath);
    unset($nodes);
    unset($node);
    $doc = null;
    $xpath = null;
    $nodes = null;
    $node = null;

    $html = str_replace('row.append($("<td>" + item.no + ""));', 'row.append($("<td>" + item.no + "</td>>"));', $html);
    return html_entity_decode($html);
}

//================================================================================
//依據class移除節點
//================================================================================
function replace_email($html){
    libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    $xpath = new DOMXPath($doc);
    $footer_right = $xpath->query("//*[contains(@class, 'footer-right')]");
    //footer_right是否有取得
    if ($footer_right){
        //ul是否有取得
        if ($footer_right->item(0)){
            $ul = $footer_right->item(0);
            //li是否有取得
            if ($ul->childNodes->item(3)){
                $li = $ul->childNodes->item(3);
                //email是否有取取得
                if ($li->childNodes->item(4)){
                    $email = $li->childNodes->item(4);
                    $email_anchor = $email->childNodes->item(2);
                    $email_anchor->setAttribute('href', 'mailto:'.EMAIL);
                    $email_anchor->nodeValue = EMAIL;
                    $html = $doc->saveHTML();
                }
            }
        }
    }

    return $html;
}

//================================================================================
//取代星光推薦
//================================================================================
function replace_recommended($html){
    libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    $figcaption = $doc->getElementsByTagName('figcaption');
    if ($figcaption){
        if ($figcaption->item(0)->childNodes->length > 0){
            $juball_node = $figcaption->item(0)->childNodes->item(0);
            if ($juball_node){
                $figcaption->item(0)->childNodes->item(0)->nodeValue = SITE_CASH_CNAME.' - 全球彩票';
            }
            $sport_node = $figcaption->item(1)->childNodes->item(0);
            if ($sport_node){
                $figcaption->item(1)->childNodes->item(0)->nodeValue = SITE_SPORT_CNAME;
            }
        }
    }
    $html = $doc->saveHTML();

    return $html;
}

//================================================================================
//移除彩票大廳
//================================================================================
function removeChoosePlan($html){
    libxml_use_internal_errors(true);
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();
    $xpath = new DOMXPath($doc);
    $choose_project = $xpath->query("//div[contains(@class, 'choose-project')]");
    if (!is_null($choose_project)){
        if ($choose_project->length > 0){
            $lis = $choose_project->item(0)->childNodes->item(1);
            if (!is_null($lis)){
                $li_lottorylobby = $lis->childNodes->item(0);
                if (!is_null($li_lottorylobby)){
                    $li_lottorylobby->setAttribute('style', 'display: none;');
                }
                $li_lottorytype = $lis->childNodes->item(2);
                if (!is_null($li_lottorytype)){
                    $li_lottorytype->setAttribute('style', 'display: none;');
                }
                $li_lottoryplan = $lis->childNodes->item(4);
                if (!is_null($li_lottoryplan)){
                    $li_lottoryplan->setAttribute('style', 'display: none;');
                }
                $ssc_digit = $lis->childNodes->item(6);
                if (!is_null($ssc_digit)) {
                    $ssc_digit->setAttribute('style', 'display: list-item;');
                    $digit_1 = $ssc_digit->childNodes->item(1);
                    if (!is_null($digit_1)) {
                        $digit_1->setAttribute('style', 'display: none;');
                    }
                }
            }
        }
    }
    $html = $doc->saveHTML();

    return $html;
}
