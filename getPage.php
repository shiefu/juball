<?php

require_once "functions.php";

//將傳進來的參數名稱、值轉成小寫
$request = array_change_key_case($_REQUEST, CASE_LOWER);

//檢查pagename參數
if (!isset($request["pagename"])){
    die("Parameter pagename NOT found");
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,SOURCE_DOMAIN."/?c=member&a=login&run=1");
curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookiefile");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=".USERNAME."&password=".PASSWORD);

ob_start();      // prevent any output
curl_exec($ch); // execute the curl command
ob_end_clean();  // stop preventing output

curl_close($ch);
unset($ch);

//跟原始網站取得資料
$source_url = str_replace('getPage.php?pagename=', '', basename($_SERVER["REQUEST_URI"]));
$ch = curl_init( SOURCE_DOMAIN.'/'.$source_url );
//curl_setopt( $ch, CURLOPT_COOKIE, "99sport_auth=".AUTH_COOKIE);
curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/cookiefile");
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec( $ch );

//取得pagetype
$pagetype = getPageType($_REQUEST["pagename"]);

//取得處理過後的內容
$html = replace_html($pagetype, $html);
//file_put_contents('aaa.html', $html);

echo $html;
